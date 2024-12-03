<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    public function index()
    {
        return view('videos.index', [
            'videos' => Video::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'yt_code' => 'required',
        ];

        // Define custom error messages
        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'yt_code.required' => 'youtube code wajib diisi!',
        ];

        // $validatedData = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Alert::error('Gagal!', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Video::create([
            'judul' => $request->judul,
            'yt_code' => $request->yt_code,
        ]);


        Alert::success('Hore!', 'Video Berhasil Dibuat');
        return redirect(route('video'));

    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);

        $rules = [
            'judul' => 'required',
            'yt_code' => 'required',
        ];

        // Define custom error messages
        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'yt_code.required' => 'youtube code wajib diisi!',
        ];

        // $validatedData = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Alert::error('Gagal!', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $video->update([
            'judul' => $request->judul,
            'yt_code' => $request->yt_code,
        ]);

        Alert::success('Hore!', 'Video Berhasil Di Edit');
        return redirect(route('video'));
    }

    public function destroy($id)
    {
        $video = Video::find($id);

        $video->delete();

        alert()->success('Hore!','video Berhasil Dihapus');
        return redirect(route('video'));
    }
}
