<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'pendaftaran';
    protected $primaryKey = "id";
    protected $fillable = [
        'id_pendaftaran',
        'user_id',
        'nama_siswa',
        'nim',
        'prodi',
        'alasan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pas_foto',
        'CV',
        'bukti_yt',
        'bukti_ig',

        //kontak
        'email',
        'hp',

        //alamat
        'alamat',

        //data pendaftaran
        'gelombang',
        'tahun_masuk',
        'pil1',
        'pil2',

        'status_pendaftaran',
        'tgl_pendaftaran',
        'created_at'
    ];

    // // relasi provinsi
    // public function province()
    // {
    //     return $this->belongsTo(Province::class, 'provinsi_id');
    // }

    // // relasi kabupaten
    // public function regency()
    // {
    //     return $this->belongsTo(Regency::class, 'kabupaten_id');
    // }

    // // relasi kecamatan
    // public function district()
    // {
    //     return $this->belongsTo(District::class, 'kecamatan_id');
    // }

    // // relasi kelurahan
    // public function village()
    // {
    //     return $this->belongsTo(Village::class, 'kelurahan_id');
    // }

    public static function id()
    {
        $data = DB::table('pendaftaran')->orderby('id_pendaftaran','DESC')->first();
        $kodeakhir5 = substr($data->id_pendaftaran,-4);
        $kodeku= (int)$kodeakhir5;
        $addNol = '';
        $kodetb = 'PENDAB';
        $kode = (int)$kodeku + 1;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        } elseif (strlen($kode) == 4) {
            $addNol = "";
        }
        $kodeBaru = $kodetb.now()->format('y').$addNol.$kode;
    	return $kodeBaru;
    }

    public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }

     public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    // public function skolah(){
    //     return $this->belongsTo(Sekolah::class,'sekolah');
    // }

    public function jadwal(){
        return $this->belongsTo(JadwalKegiatan::class,'gelombang');
    }

    public function pilihan1(){
        return $this->belongsTo(Divisi::class,'pil1');
    }

    public function pilihan2(){
        return $this->belongsTo(Divisi::class,'pil2');
    }
}
