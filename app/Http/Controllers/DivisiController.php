<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class DivisiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            if (session('warning')) {
                Alert::warning(session('warning'));
            }
            return $next($request);
        });
    }


    //data divisi kompliit
    public function datadivisi(){
        $viewData = Divisi::all();
        return view ('divisi.data-divisi-admin',compact('viewData'));
    }

    public function simpandivisi(Request $a)
    {
        try{

            $kode=Divisi::id();

            $fileft = $a->file('foto');
            if(file_exists($fileft)){
                $nama_fileft = "Divisi".time() . "-" . $fileft->getClientOriginalName();
                $namaFolderft = 'foto divisi';
                $fileft->move($namaFolderft,$nama_fileft);
                $path = $namaFolderft."/".$nama_fileft;
            } else {
                $path = null;
            }

            Divisi::create([
                'id_divisi' => $kode,
                'nama_divisi' => $a->nama,
                'foto_divisi' => $path,
        ]);
            return redirect('/data-divisi')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            echo $e;
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatedivisi(Request $a, $id_divisi){
        //$dataUser = Pengguna::all();
        try{
            $fileft = $a->file('foto');
            if(file_exists($fileft)){
                $nama_fileft = "Divisi".time() . "-" . $fileft->getClientOriginalName();
                $namaFolderft = 'foto divisi';
                $fileft->move($namaFolderft,$nama_fileft);
                $path = $namaFolderft."/".$nama_fileft;
            } else {
                $path = $a->pathnya;
            }
            Divisi::where("id", $id_divisi)->update([
                'nama_divisi' => $a->nama,
                'foto_divisi' => $path,
        ]);
            return redirect('/data-divisi')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapusdivisi($id_divisi){
        //$dataUser = Pengguna::all();
        try{
            $data = Divisi::find($id_divisi);
            $data->delete();
            return redirect('/data-divisi')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
