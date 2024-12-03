<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

// use Illuminate\Support\Facades\Validator;
//  use Intervention\Image\Image;
// use Intervention\Image\Laravel\Facades\Image;
// use Intervention\Image\Laravel\Facades\Image;
// use Image;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index',[
            'artikels' =>Blog::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
{
    // Define validation rules
    $rules = [
        'judul' => 'required',
        'image' => 'required|max:10000|mimes:jpg,jpeg,png,webp',
        'desc' => 'required|min:20',
    ];

    // Define custom error messages
    $messages = [
        'judul.required' => 'Judul wajib diisi!',
        'image.required' => 'Gambar wajib diisi!',
        'image.max' => 'Ukuran gambar maksimal 10MB!',
        'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp!',
        'desc.required' => 'Deskripsi wajib diisi!',
        'desc.min' => 'Deskripsi harus minimal 20 karakter!',
    ];

    // $this->validate($request,$rules,$messages);
    $validatedData = $request->validate($rules, $messages);
    // return redirect()->back()->with('success', 'Data has been saved successfully!');

     // Image
     $fileName = time() . '.' . $request->image->extension();
     $request->file('image')->storeAs('public/artikel', $fileName);

     # Artikel
     $storage = "storage/content-artikel";
     $dom = new \DOMDocument();

     # untuk menonaktifkan kesalahan libxml standar dan memungkinkan penanganan kesalahan pengguna.
     libxml_use_internal_errors(true);
     $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
     # Menghapus buffer kesalahan libxml
     libxml_clear_errors();

     # Baca di https://dosenit.com/php/fungsi-libxml-php
     $images = $dom->getElementsByTagName('img');

     foreach ($images as $img) {
         $src = $img->getAttribute('src');
         if (preg_match('/data:image/', $src)) {
             preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
             $mimetype = $groups['mime'];
             $fileNameContent = uniqid();
             $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
             $filePath = ("$storage/$fileNameContentRand.$mimetype");
             $image = Image::make($src)->resize(1440, 720)->encode($mimetype, 100)->save(public_path($filePath));
            // try {
            //     $image = Image::make($src)->resize(1440, 720)->encode($mimetype, 100)->save(public_path($filePath));
            // } catch (\Exception $e) {
            //     return back()->withErrors('Terjadi kesalahan saat memproses gambar: ' . $e->getMessage());
            // }
            $new_src = asset($filePath);
             $img->removeAttribute('src');
             $img->setAttribute('src', $new_src);
             $img->setAttribute('class', 'img-responsive');
         }
     }
     Blog::create([
         'judul' => $request->judul,
         'slug' => Str::slug($request->judul, '-'),
         'image' => $fileName,
         'desc' => $dom->saveHTML(),
     ]);

    //  return redirect(route('blog'))->with('success', 'data berhasil di simpan');
     Alert::success('Hore!', 'Artikel Berhasil Di Buat');
     return redirect(route('blog'));

    }



    public function edit($id)
    {
        $artikel = Blog::find($id);
        return view('blogs.edit', [
            'artikel' => $artikel
        ]);
    }

    public function update(Request $request, $id)
    {
        $artikel = Blog::find($id);

        # Jika ada image baru
        if ($request->hasFile('image')) {
            $fileCheck = 'required|max:10000|mimes:jpg,jpeg,png';
        } else {
            $fileCheck = '';
        }

        $rules = [
            'judul' => 'required',
            'image' => $fileCheck,
            'desc' => 'required|min:20',
        ];

        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'image.required' => 'Image wajib diisi!',
            'desc.required' => 'Desc wajib diisi!',
        ];

        $validatedData = $request->validate($rules, $messages);
        // $this->validate($request, $rules, $messages);

        // Cek jika ada image baru
        if ($request->hasFile('image')) {
            if (\File::exists('storage/artikel/' . $artikel->image)) {
                \File::delete('storage/artikel/' . $request->old_image);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/artikel', $fileName);
        }

        if ($request->hasFile('image')) {
            $checkFileName = $fileName;
        } else {
            $checkFileName = $request->old_image;
        }

        // Artikel
        $storage = "storage/content-artikel";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->resize(1200, 1200)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $artikel->update([
            'judul' => $request->judul,
            'image' => $checkFileName,
            'desc' => $dom->saveHTML(),
        ]);

        Alert::success('Hore!', 'Artikel Berhasil Di Edit');
        return redirect(route('blog'));
        // return redirect(route('blog'))->with('toast_success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $artikel = Blog::find($id);
        if (\File::exists('storage/artikel/' . $artikel->image)) {
            \File::delete('storage/artikel/' . $artikel->image);
        }

        $artikel->delete();

        alert()->success('Hore!','Artikel Berhasil Dihapus');
        return redirect(route('blog'));
    }

        // Method untuk update status artikel
        public function updateStatus(Request $request)
        {
            $artikel = Blog::find($request->id);
            if ($artikel) {
                $artikel->status = $request->status;
                $artikel->save();

                return response()->json(['success' => 'Status berhasil diubah.']);
            }

            return response()->json(['error' => 'Artikel tidak ditemukan.'], 404);
        }

}
