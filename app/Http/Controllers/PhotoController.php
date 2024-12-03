<?php
namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function index()
    {
        return view('photos.index', [
            'photos' => Photo::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|max:10000|mimes:jpg,jpeg,png,webp',
            'judul' => 'required',
        ];

        // Define custom error messages
        $messages = [
            'image.required' => 'Gambar wajib diisi!',
            'judul.required' => 'Judul wajib diisi!',
            'image.max' => 'Ukuran gambar maksimal 10MB!',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp!',
        ];

        // $validatedData = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Alert::error('Gagal!', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Image
        $fileName = time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('public/photo', $fileName);

        Photo::create([
            'judul' => $request->judul,
            'image' => $fileName,
        ]);


        Alert::success('Hore!', 'Foto Berhasil Dibuat');
        return redirect(route('photo'));

    }

    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);

        if ($request->hasFile('image')) {
            $fileCheck = 'required|max:10000|mimes:jpg,jpeg,png,webp';
        } else {
            $fileCheck = '';
        }

        $rules = [
            'image' => $fileCheck,
            'judul' => 'required',
        ];

        $messages = [
            'image.required' => 'Gambar wajib diisi!',
            'judul.required' => 'Judul wajib diisi!',
            'image.max' => 'Ukuran gambar maksimal 10MB!',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp!',
        ];

        // $validatedData = $request->validate($rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Alert::error('Gagal!', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

         // Cek jika ada image baru
         if ($request->hasFile('image')) {
            if (\File::exists('storage/photo/' . $photo->image)) {
                \File::delete('storage/photo/' . $request->old_image);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/photo', $fileName);
        }

        if ($request->hasFile('image')) {
            $checkFileName = $fileName;
        } else {
            $checkFileName = $request->old_image;
        }

        $photo->update([
            'judul' => $request->judul,
            'image' => $checkFileName,
        ]);

        Alert::success('Hore!', 'Photo Berhasil Di Edit');
        return redirect(route('photo'));
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        if (\File::exists('storage/photo/' . $photo->image)) {
            \File::delete('storage/photo/' . $photo->image);
        }

        $photo->delete();

        alert()->success('Hore!','Photo Berhasil Dihapus');
        return redirect(route('photo'));
    }

    public function updateStatus(Request $request)
    {
        $photo = Photo::find($request->id);
        if ($photo) {
            $photo->status = $request->status;
            $photo->save();

            return response()->json(['success' => 'Status foto berhasil diubah.']);
        }

        return response()->json(['error' => 'Foto tidak ditemukan.'], 404);
    }
}
