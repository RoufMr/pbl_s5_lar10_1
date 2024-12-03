<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;
// use App\Models\ProgramStudi;
use DateTime;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create ProgramStudi
        Divisi::create([
            'id_divisi' => 'DIV001',
            'nama_divisi' => 'SYIAR',
            'foto_divisi' => 'foto divisi/syiar.jpg',
            'created_at' => now()
        ]);
        Divisi::create([
            'id_divisi' => 'DIV002',
            'nama_divisi' => 'Informasi dan Publikasi',
            'foto_divisi' => 'foto divisi/informasi dan publikasi.jpg',
            'created_at' => now()
        ]);
        Divisi::create([
            'id_divisi' => 'DIV003',
            'nama_divisi' => 'Pengabdian Masyarkat',
            'foto_divisi' => 'foto divisi/pengmas.jpg',
            'created_at' => now()
        ]);
        Divisi::create([
            'id_divisi' => 'DIV004',
            'nama_divisi' => 'Kemuslimahan',
            'foto_divisi' => 'foto divisi/kemuslimahan.jpg',
            'created_at' => now()
        ]);
        Divisi::create([
            'id_divisi' => 'DIV005',
            'nama_divisi' => 'Seni Budaya Islam',
            'foto_divisi' => 'foto divisi/seni budaya islam.jpg',
            'created_at' => now()
        ]);
        Divisi::create([
            'id_divisi' => 'DIV006',
            'nama_divisi' => 'Pengembangan Sumber Daya Mahasiswa',
            'foto_divisi' => 'foto divisi/psdm.jpg',
            'created_at' => now()
        ]);
    }
}
