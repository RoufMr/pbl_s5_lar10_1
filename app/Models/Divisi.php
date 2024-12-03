<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Divisi extends Model
{
    use HasFactory;
    protected $table = "divisi";
    protected $primaryKey= "id";
    protected $fillable = ["id_divisi","nama_divisi","foto_divisi"];
    public $timestamps = false;
    public $incrementing = false;

    public static function id()
    {
    	$kode = DB::table('divisi')->max('id');
    	$addNol = '';
    	$kode = str_replace("DIV", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
        }
    	$kodeBaru = "DIV".$addNol.$incrementKode;
    	return $kodeBaru;
    }

    public function pengumuman()
    {
    return $this->belongsTo(Pengumuman::class);
    }

    public function pendaftaran(){
        return $this->hasMany(Pendaftaran::class);
    }
}
