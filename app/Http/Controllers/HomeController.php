<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Photo;
use App\Models\Rapat;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    return view('home.main', [
        'artikels' => Blog::where('status', true)->orderBy('id', 'desc')->limit(3)->get(), // Menampilkan artikel aktif
        'videos' => Video::orderBy('id', 'desc')->limit(3)->get(),
        'photos' => Photo::where('status', true)->orderBy('id', 'desc')->limit(4)->get(), // Menampilkan foto aktif
    ]);
}


public function berita()
{
    return view('home.beritas.berita', [
        'artikels' => Blog::where('status', true)->orderBy('id', 'desc')->get(),
    ]);
}

    public function detail($slug)
    {
        $artikel = Blog::where('slug',$slug)->first();
        return view('home.beritas.detail',[
            'artikel' => $artikel
        ]);
    }
    public function photo()
    {
        return view('home.photos.photo', [
            'photos' => Photo::where('status', true)->orderBy('id', 'desc')->get() // Hanya menampilkan foto yang aktif
        ]);
    }
    // public function rapat()
    // {
    //     return view('rapats.rapat',[
    //         'rapats' =>Rapat::orderBy('id','desc')->get()
    //     ]);
    // }
}
