<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\ProfileUsers;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Timeline;
use App\Models\JadwalKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Carbon;
use File;
use Alert;

class PendaftaranController extends Controller
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

    //data pendaftaran kompliit
    public function datapendaftaran(){
        $dataUser = ProfileUsers::all();
        $data = Pendaftaran::all();
        $datapembayaran = Pembayaran::all();
        return view ('pendaftaran.data-pendaftaran-admin',['viewDataPembayaran' => $datapembayaran, 'viewDataUser' => $dataUser,'viewData' => $data]);
    }

    public function inputpendaftaran(){
        $datadiv = Divisi::all();
        $datenow = date('Y-m-d');
        $dataJadwal = JadwalKegiatan::where("tgl_mulai","<=",$datenow)->where("tgl_akhir",">",$datenow)->where("jenis_kegiatan","Pendaftaran")->get();
        return view ('pendaftaran.data-pendaftaran-input-admin',['viewDataJadwal' => $dataJadwal,'viewDivisi' => $datadiv]);
    }

    public function simpanpendaftaran(Request $a)
    {
        try{
        $dataUser = ProfileUsers::all();
        // $message = [
        //     'nisn.required' => 'NISN must be filled',
        //     'nik.required' => 'NIK must be filled',
        //     'nama.required' => 'Name must be filled',
        //     'jk.required' => 'Gender must be filled',
        //     'foto.required' => 'Photo cannot be empty',
        //     'tempatlahir.required' => 'Birthplace must be filled',
        //     'tanggallahir.required' => 'Date of birth must be filled',
        //     'agama.required' => 'Religion must be filled',
        //     'alamat.required' => 'Address must be filled',
        //     'email.required' => 'Email must be filled',
        //     'nohp.required' => 'Mobile phone must be filled',
        //     'gelombang.required' => 'Batch must be filled',
        //     'pil1.required' => 'Prodi choice must be filled',
        //     'pil2.required' => 'Prodi choice must be filled',
        //     'ayah.required' => 'Father`s name must be filled',
        //     'ibu.required' => 'Mother`s name must be filled',
        //     'pekerjaanayah.required' => 'Father`s occupation must be filled',
        //     'pekerjaanibu.required' => 'Mother`s occupation must be filled',
        //     'noayah.required' => 'Father`s phone number must be filled',
        //     'noibu.required' => 'Mother`s phone number must be filled',
        //     'penghasilan_ayah.required' => 'PaySlip must be filled',
        //     'penghasilan_ibu.required' => 'PaySlip must be filled',
        //     'ftberkas.required' => 'PaySlip cannot be empty',
        //     'sekolah.required' => 'School name must be filled',
        //     'smt1.required' => 'Semester 1 must be filled',
        //     'smt2.required' => 'Semester 2 must be filled',
        //     'smt3.required' => 'Semester 3 must be filled',
        //     'smt4.required' => 'Semester 4 must be filled',
        //     'smt5.required' => 'Semester 5 must be filled',
        //     'ftberkas_siswa.required' => 'Raport cannot be empty',
        // ];

        // $cekValidasi = $a->validate([
        //     'nisn' => 'required',
        //     'nik' => 'required',
        //     'nama' => 'required',
        //     'jk' => 'required',
        //     'foto' => 'required',
        //     'tempatlahir' => 'required',
        //     'tanggallahir' => 'required',
        //     'agama' => 'required',
        //     'alamat' => 'required',
        //     'email' => 'required',
        //     'nohp' => 'required',
        //     'gelombang' => 'required',
        //     'pil1' => 'required',
        //     'pil2' => 'required',
        //     'ayah' => 'required',
        //     'ibu' => 'required',
        //     'pekerjaanayah' => 'required',
        //     'pekerjaanibu' => 'required',
        //     'noayah' => 'required',
        //     'noibu' => 'required',
        //     'penghasilan_ayah' => 'required',
        //     'penghasilan_aibu' => 'required',
        //     'ftberkas_ortu' => 'required',
        //     'sekolah' => 'required',
        //     'smt1' => 'required',
        //     'smt2' => 'required',
        //     'smt3' => 'required',
        //     'smt4' => 'required',
        //     'smt5' => 'required',
        //     'ftberkas_siswa' => 'required'
        // ], $message);

        $kodependaftaran = Pendaftaran::id();


        $file = $a->file('foto');
        $nama_file = "Pasfoto".time() . "-" . $file->getClientOriginalName();
        $namaFolder = 'data pendaftar/'.$kodependaftaran;
        $file->move($namaFolder,$nama_file);
        $pathFoto = $namaFolder."/".$nama_file;

        $fileCV = $a->file('CV');
        $nama_fileCV = "CV".time() . "-" . $fileCV->getClientOriginalName();
        $namaFolderCV = 'data pendaftar/'.$kodependaftaran;
        $fileCV->move($namaFolderCV,$nama_fileCV);
        $pathFotoCV = $namaFolderCV."/".$nama_fileCV;

        $fileYT = $a->file('bukti_yt');
        $nama_fileYT = "Bukti_yt".time() . "-" . $fileYT->getClientOriginalName();
        $namaFolderYT = 'data pendaftar/'.$kodependaftaran;
        $fileYT->move($namaFolderYT,$nama_fileYT);
        $pathFotoYT = $namaFolderYT."/".$nama_fileYT;

        $fileIG = $a->file('bukti_ig');
        $nama_fileIG = "Bukti_ig".time() . "-" . $file->getClientOriginalName();
        $namaFolderIG = 'data pendaftar/'.$kodependaftaran;
        $fileIG->move($namaFolderIG,$nama_fileIG);
        $pathFotoIG = $namaFolderIG."/".$nama_fileIG;

        // $fileftberkas_ortu = $a->file('ftberkas_ortu');
        // $nama_fileftberkas_ortu = "BerkasOrtu".time() . "-" . $fileftberkas_ortu->getClientOriginalName();
        // $namaFolderftgaji = 'data pendaftar/'.$kodependaftaran;
        // $fileftberkas_ortu->move($namaFolderftgaji,$nama_fileftberkas_ortu);
        // $pathOrtu = $namaFolderftgaji."/".$nama_fileftberkas_ortu;


        // $fileftberkas_siswa = $a->file('ftberkas_siswa');
        // $nama_fileftberkas_siswa = "BerkasSiswa".time() . "-" . $fileftberkas_siswa->getClientOriginalName();
        // $namaFolderftraport = 'data pendaftar/'.$kodependaftaran;
        // $fileftberkas_siswa->move($namaFolderftraport,$nama_fileftberkas_siswa);
        // $pathSiswa = $namaFolderftraport."/".$nama_fileftberkas_siswa;

        // $fileftprestasi = $a->file('ftprestasi');
        // if(file_exists($fileftprestasi)){
        //     $nama_fileftprestasi = "Prestasi".time() . "-" . $fileftprestasi->getClientOriginalName();
        //     $namaFolderftprestasi = 'data pendaftar/'.$kodependaftaran;
        //     $fileftprestasi->move($namaFolderftprestasi,$nama_fileftprestasi);
        //     $pathPrestasi = $namaFolderftprestasi."/".$nama_fileftprestasi;
        // } else {
        //     $pathPrestasi = null;
        // }

        Pendaftaran::create([
            'id_pendaftaran' => $kodependaftaran,
            'user_id' => Auth::user()->id,
            'nama_siswa' => $a->nama,
            'nim' => $a->nim,
            'prodi' => $a->prodi,
            'alasan' => $a->alasan,
            'jenis_kelamin' => $a->jk,
            'tempat_lahir' => $a->tempatlahir,
            'tanggal_lahir' => $a->tanggallahir,
            'agama' => $a->agama,
            'pas_foto' => $pathFoto,
            'CV' => $pathFotoCV,
            'bukti_yt' => $pathFotoYT,
            'bukti_ig' => $pathFotoIG,

            'email' => $a->email,
            'hp' => $a->nohp,

            'alamat' => $a->alamat,

            //pendaftaran
            'gelombang' => $a->gelombang,
            'tahun_masuk' => '2024',
            'pil1' => $a->pil1,
            'pil2' => $a->pil2,

            'status_pendaftaran' => 'Belum Terverifikasi',
            'tgl_pendaftaran' => now(),
            'created_at' => now()
        ]);
        $pendaftaranbaru = Pendaftaran::orderBy('id','DESC')->first();
        $id_pendaftaran = $pendaftaranbaru->id;

        //tambah insert
        $kodepembayaran = Pembayaran::id();
        echo $kodepembayaran;
        Pembayaran::create([
            'id_pembayaran' => $kodepembayaran,
            //'bukti_pembayaran' => "NULL",
            'status'=> "Belum Bayar",
            'verifikasi'=> false,
            'jatuh_tempo'  => now()->addDays(2)->format('Y-m-d'),
            'tgl_pembayaran' => now(),
            'total_bayar'  => 15000,
            'id_pendaftaran' =>$id_pendaftaran,
            'created_at' => now()
        ]);

        $kodepengumuman = Pengumuman::id();
        Pengumuman::create([
            'id_pengumuman' => $kodepengumuman,
            'id_pendaftaran' => $id_pendaftaran,
            'hasil_seleksi' => "Belum Seleksi",
            'status' => false,
        ]);

        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan pendaftaran penerimaan mahasiswa baru",
            'tgl_update' => now(),
            'created_at' => now()
        ]);

        return redirect('/data-registration')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            echo $e->getMessage();
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Tersimpan!');
        }
    }

    public function verifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Terverifikasi"
        ]);
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan verifikasi pendaftaran ".$id_pendaftaran,
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-registration');
    }

    public function notverifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Belum Terverifikasi"
        ]);
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Belum Terverifikasi)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-registration');
    }

    public function invalidstatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Tidak Sah"
        ]);
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Tidak Sah)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-registration');
    }

    public function selesaistatuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Selesai"
        ]);
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan perubahan verifikasi pendaftaran ".$id_pendaftaran." (Umumkan)",
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-registration');
    }


    public function editpendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        $datadiv = Divisi::all();
        $datenow = date('Y-m-d');
        $dataJadwal = JadwalKegiatan::where("tgl_mulai","<=","$datenow")->where("tgl_akhir",">","$datenow")->where("jenis_kegiatan","Pendaftaran")->get();
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        return view('pendaftaran.data-pendaftaran-edit-admin', ['viewDataJadwal' => $dataJadwal,'viewDataUser' => $dataUser,'viewData' => $data,'viewDivisi' => $datadiv]);
    }

    public function updatependaftaran(Request $a, $id_pendaftaran){

        try{
        // $message = [
        //     'nisn.required' => 'NISN must be filled',
        //     'nik.required' => 'NIK must be filled',
        //     'nama.required' => 'Name must be filled',
        //     'jk.required' => 'Gender must be filled',
        //     'foto.required' => 'Photo cannot be empty',
        //     'tempatlahir.required' => 'Birthplace must be filled',
        //     'tanggallahir.required' => 'Date of birth must be filled',
        //     'agama.required' => 'Religion must be filled',
        //     'alamat.required' => 'Address must be filled',
        //     'email.required' => 'Email must be filled',
        //     'nohp.required' => 'Mobile phone must be filled',
        //     'gelombang.required' => 'Batch must be filled',
        //     'pil1.required' => 'Prodi choice must be filled',
        //     'pil2.required' => 'Prodi choice must be filled',
        //     'ayah.required' => 'Father`s name must be filled',
        //     'ibu.required' => 'Mother`s name must be filled',
        //     'pekerjaanayah.required' => 'Father`s occupation must be filled',
        //     'pekerjaanibu.required' => 'Mother`s occupation must be filled',
        //     'noayah.required' => 'Father`s phone number must be filled',
        //     'noibu.required' => 'Mother`s phone number must be filled',
        //     'penghasilan_ayah.required' => 'PaySlip must be filled',
        //     'penghasilan_ibu.required' => 'Family dependents must be filled',
        //     'ftberkas_ortu.required' => 'Berkas cannot be empty',
        //     'sekolah.required' => 'School name must be filled',
        //     'smt1.required' => 'Semester 1 must be filled',
        //     'smt2.required' => 'Semester 2 must be filled',
        //     'smt3.required' => 'Semester 3 must be filled',
        //     'smt4.required' => 'Semester 4 must be filled',
        //     'smt5.required' => 'Semester 5 must be filled',
        //     'ftberkas_siswa.required' => 'Raport cannot be empty'
        // ];

        // $cekValidasi = $a->validate([
        //     'nisn' => 'required',
        //     'nik' => 'required',
        //     'nama' => 'required',
        //     'jk' => 'required',
        //     'foto' => 'required',
        //     'tempatlahir' => 'required',
        //     'tanggallahir' => 'required',
        //     'agama' => 'required',
        //     'alamat' => 'required',
        //     'email' => 'required',
        //     'nohp' => 'required',
        //     'gelombang' => 'required',
        //     'pil1' => 'required',
        //     'pil2' => 'required',
        //     'ayah' => 'required',
        //     'ibu' => 'required',
        //     'pekerjaanayah' => 'required',
        //     'pekerjaanibu' => 'required',
        //     'noayah' => 'required',
        //     'noibu' => 'required',
        //     'penghasilan_ayah' => 'required',
        //     'penghasilan_ibu' => 'required',
        //     'ftberkas_ortu' => 'required',
        //     'sekolah' => 'required',
        //     'smt1' => 'required',
        //     'smt2' => 'required',
        //     'smt3' => 'required',
        //     'smt4' => 'required',
        //     'smt5' => 'required',
        //     'ftberkas_siswa' => 'required'
        // ], $message);

        $kodependaftaran = Pendaftaran::id();

        $file = $a->file('foto');
        if(file_exists($file)){
            $nama_file = "Pasfoto".time() . "-" . $file->getClientOriginalName();
            $namaFolder = 'data pendaftar/'.$kodependaftaran;
            $file->move($namaFolder,$nama_file);
            $pathFoto = $namaFolder."/".$nama_file;
        } else {
            $pathFoto = $a->pathFoto;
        }

        $fileCV = $a->file('CV');
        if(file_exists($fileCV)){
            $nama_fileCV = "CV".time() . "-" . $fileCV->getClientOriginalName();
            $namaFolderCV = 'data pendaftar/'.$kodependaftaran;
            $fileCV->move($namaFolderCV,$nama_fileCV);
            $pathFotoCV = $namaFolderCV."/".$nama_fileCV;
        } else {
            $pathFotoCV = $a->pathFotoCV;
        }

        $fileYT = $a->file('bukti_yt');
        if(file_exists($fileYT)){
            $nama_fileYT = "Bukti_yt".time() . "-" . $fileYT->getClientOriginalName();
            $namaFolderYT = 'data pendaftar/'.$kodependaftaran;
            $fileYT->move($namaFolderYT,$nama_fileYT);
            $pathFotoYT = $namaFolderYT."/".$nama_fileYT;
        } else {
            $pathFotoYT = $a->pathFotoYT;
        }

        $fileIG = $a->file('bukti_ig');
        if(file_exists($fileIG)){
            $nama_fileIG = "Bukti_ig".time() . "-" . $fileIG->getClientOriginalName();
            $namaFolderIG = 'data pendaftar/'.$kodependaftaran;
            $fileIG->move($namaFolderIG,$nama_fileIG);
            $pathFotoIG = $namaFolderIG."/".$nama_fileIG;
        } else {
            $pathFotoIG = $a->pathFotoIG;
        }

        Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->update([
            'nama_siswa' => $a->nama,
            'nim' => $a->nim,
            'prodi' => $a->prodi,
            'alasan' => $a->alasan,
            'jenis_kelamin' => $a->jk,
            'tempat_lahir' => $a->tempatlahir,
            'tanggal_lahir' => $a->tanggallahir,
            'agama' => $a->agama,
            'alamat' => $a->alamat,
            'pas_foto' => $pathFoto,
            'CV' => $pathFotoCV,
            'bukti_yt' => $pathFotoYT,
            'bukti_ig' => $pathFotoIG,
            'email' => $a->email,
            'hp' => $a->nohp,
            'gelombang' => $a->gelombang,
            'tahun_masuk' => '2024',
            'pil1' => $a->pil1,
            'pil2' => $a->pil2,

        ]);
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => "Pendaftaran",
            'pesan' => "Melakukan perubahan data pendaftaran ".$id_pendaftaran,
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/data-registration')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            echo $e;
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapuspendaftaran($id_pendaftaran){
        //$dataUser = ProfileUsers::all();
        try{
            $data = Pendaftaran::find($id_pendaftaran);
            File::delete($data->pas_foto);
            File::delete($data->bukti_yt);
            File::delete($data->bukti_ig);
            File::delete($data->CV);

            $dataPembayaran = Pembayaran::where("id_pendaftaran",$id_pendaftaran)->first();
            File::delete($dataPembayaran->bukti_pembayaran);
            $data->delete();
            return redirect('/data-registration')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    public function detailpendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        $datadiv = Divisi::all();
        $data = Pendaftaran::where("id_pendaftaran",$id_pendaftaran)->first();
        $datPembayaran = Pembayaran::where("id_pendaftaran",$data->id)->first();
        $no=1;


        $datapembayaran = Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->get();
        return view('pendaftaran.data-pendaftaran-detail', ['viewDataUser' => $dataUser,'viewDataPembayaran' => $datPembayaran,'viewData' => $data,'viewDivisi' => $datadiv]);
    }

    public function kartupendaftaran($id_pendaftaran)
    {
        $dataUser = ProfileUsers::all();
        $datadiv = Divisi::all();
        $data = Pendaftaran::find($id_pendaftaran);
        return view('pendaftaran.data-pendaftaran-kartu-admin', ['viewDataUser' => $dataUser,'viewData' => $data,'viewDivisi' => $datadiv]);
    }
}
