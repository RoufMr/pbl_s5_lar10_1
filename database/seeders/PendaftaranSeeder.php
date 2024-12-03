<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pendaftaran')->insert([
            'id_pendaftaran' => 'PENDAB00001',
            'user_id' =>2,
            'nama_siswa' => 'M. Rouf Mubarok',
            'nim' => '362258302195',
            'prodi' => 'TRPL',
            'alasan' => 'sayasuka',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Purwakarta',
            'tanggal_lahir' => now(),
            'agama' => 'Islam',
            'pas_foto' => 'image/DSC_0093.jpg',
            'CV' => 'image/DSC_0093.jpg',
            'bukti_yt' => 'image/DSC_0093.jpg',
            'bukti_ig' => 'image/DSC_0093.jpg',

            //kontak
            'email'  => 'rouf@gmail.com',
            'hp'  => '123456789121',

            //alamat
            'alamat'  => 'data pendaftar alamat',


            //data pendaftaran
            'gelombang'  => 1,
            'tahun_masuk'  => '2024',
            'pil1'  => 1,
            'pil2'  => 2,

            // TODO: belum jadi
            'tgl_pendaftaran' =>now(),
            'created_at' => now(),
            'status_pendaftaran'  => "Selesai",
        ]);

        DB::table('pembayaran')->insert([
            'id_pembayaran' => 'PEMPSB00001',
            'status' => "Dibayar",
            'verifikasi'  => true,
            'jatuh_tempo'  => Carbon::now()->addDays(2)->format('Y-m-d'),
            'tgl_pembayaran'  => Carbon::now()->addDays(1)->format('Y-m-d'),
            'total_bayar'  => 150000,
            'bukti_pembayaran'  => 'file/sample-buktipembayaran.jpg',
            'id_pendaftaran' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('pengumuman')->insert([
            'id_pengumuman' => 'PENGAB00001',
            'status' => false,
            'hasil_seleksi'  => 'LULUS',
            'divisi_penerima' => 1,
            'nilai_interview' => 100,
            'nilai_test' => 100,
            'id_pendaftaran' => 1,
            'user_id' => 2,
            'created_at' => Carbon::now(),
        ]);
    }
}
