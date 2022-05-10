<?php

namespace App\Http\Controllers\Admin;

use  App\Http\Controllers\Controller;
use App\Http\Models\Song;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    use SoftDeletes;

    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function index()
    {
        $songs = $this->song->getAll();
        return view('admin.song.index', [
            'songs' => $songs
        ]);
    }

    public function create()
    {
        return view('admin.song.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->song->create($request->all());
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
        $song = $this->song->find($id);

        return view('admin.song.edit', ['song' => $song]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

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
