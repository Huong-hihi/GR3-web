<?php

namespace App\Http\Controllers\Admin;

use  App\Http\Controllers\Controller;
use App\Http\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use SoftDeletes;

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->getAll();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $parentCategories = $this->category->getAll();

        return view('admin.category.create', ['parentCategories' => $parentCategories]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
//            dd($request->all());
            $this->category->create($request->all());
            DB::commit();

            return redirect()->route('admin.category.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.category.index')->with('status', 'false');
        }
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $parentCategories = $this->category->getAllWithoutId($id);

        return view('admin.category.edit',
            [
                'category' => $category,
                'parentCategories' => $parentCategories
            ]);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $this->category->find($id)->update($data);

            DB::commit();

            return redirect()->route('admin.category.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.category.index')->with('status', 'false');
        }
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();

        return redirect()->route('admin.category.index');
    }

}
