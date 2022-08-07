<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use App\Http\Models\Singer;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class SingerController extends Controller
{
    use SoftDeletes;

    private $singer;
    private $user;
    private $file;

    public function __construct(Singer $singer, User $user, File $file)
    {
        $this->singer = $singer;
        $this->user = $user;
        $this->file = $file;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $singers = Singer::when(isset($input['search']), function ($q) use ($input) {
            $q->where('id', $input['search'])
                ->orWhere('name', 'like', '%' . $input['search'] . '%');
        })->paginate(10);

        return view('admin.singer.index', [
            'singers' => $singers
        ]);
    }

    public function create()
    {
        return view('admin.singer.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['image'] = $this->file->saveFileToLocal($request, 'image', 'images/singer');
            $this->singer->store($data);

            DB::commit();

            return redirect()->route('admin.singer.index')->with('status', 'success');

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.singer.index')->with('status', 'false');
        }
    }

    public function edit($id)
    {
        $singer = $this->singer->find($id);

        return view('admin.singer.edit', ['singer' => $singer]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['image'] = $this->file->saveFileToLocal($request, 'image', 'images/singer');

            $this->singer->updateSinger($data, $id);

            DB::commit();

            return redirect()->route('admin.singer.index')->with('status', 'success');

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.singer.index')->with('status', 'false');
        }
    }

    public function delete($id)
    {
        $this->singer->deleteSinger($id);

        return redirect()->route('admin.singer.index');
    }

}
