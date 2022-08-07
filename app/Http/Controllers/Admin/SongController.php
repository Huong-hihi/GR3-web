<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Singer;
use App\Http\Models\Song;
use App\Traits\File;
use Illuminate\Http\Request;
use App\Http\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;

class SongController extends Controller
{
    use SoftDeletes;

    private $song;
    private $category;
    private $file;

    public function __construct(Song $song, Category $category, File $file)
    {
        $this->song = $song;
        $this->category = $category;
        $this->file = $file;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $songs = Song::when(isset($input['search']), function ($q) use ($input) {
            $q->where('id', $input['search'])
                ->orWhere('name', 'like', '%' . $input['search'] . '%');
        })
            ->with('category')
            ->paginate(10);

        return view('admin.song.index', [
            'songs' => $songs
        ]);
    }

    public function create()
    {
        $parentCategories = $this->category->getAll();
        $listSingerName = Singer::all();

        return view('admin.song.create', ['parentCategories' => $parentCategories, 'listSingerName' => $listSingerName]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['image'] = $this->file->saveFileToLocal($request, 'image', 'images/song');
            $data['file_mp3'] = $this->file->saveFileToLocal($request, 'mp3', 'audios/song');
            $this->song->store($data);
            DB::commit();

            return redirect()->route('admin.song.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.song.index')->with('status', 'false');
        }
    }

    public function edit($id)
    {
        $song = Song::where('id', $id)->with('singer')->first();
        $parentCategories = $this->category->getAll();
        $listSingerName = Singer::all();

        return view('admin.song.edit', ['song' => $song, 'parentCategories' => $parentCategories, 'listSingerName' => $listSingerName]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $data['image'] = $this->file->saveFileToLocal($request, 'image', 'images/song');
            $data['file_mp3'] = $this->file->saveFileToLocal($request, 'mp3', 'audios/song');

            if (!$data['image']) unset($data['image']);
            if (!$data['file_mp3']) unset($data['file_mp3']);

            $countSinger = Singer::where('name', $data['singer_name'])->count();
            if ($countSinger == 0) unset($data['singer_name']);

            $this->song->find($id)->update($data);

            DB::commit();

            return redirect()->route('admin.song.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.song.index')->with('status', 'false');
        }
    }

    public function delete($id)
    {
        $this->song->find($id)->delete();

        return redirect()->route('admin.song.index');
    }

}
