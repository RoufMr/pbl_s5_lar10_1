<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->string('nama_siswa');
                $table->string('nim');
                $table->string('prodi');
                $table->longText('alasan');
                $table->string('jenis_kelamin');
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->string('agama')->nullable();
                $table->string('pas_foto')->nullable();
                $table->string('CV');
                $table->string('bukti_yt');
                $table->string('bukti_ig');

            //Kontak
            $table->string('email')->nullable();
            $table->string('hp')->nullable();

            // Alamat lengkap
            $table->string('alamat')->nullable();

            $table->string('provinsi_id')->nullable();
            // $table->foreign('provinsi_id')
            //     ->references('id')
            //     ->on('provinces')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kabupaten_id')->nullable();
            // $table->foreign('kabupaten_id')
            //     ->references('id')
            //     ->on('regencies')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kecamatan_id')->nullable();
            // $table->foreign('kecamatan_id')
            //     ->references('id')
            //     ->on('districts')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kelurahan_id')->nullable();
            // $table->foreign('kelurahan_id')
            //     ->references('id')
            //     ->on('villages')
            //     ->onUpdate('cascade')->onDelete('cascade');

            //data pendaftaran
            $table->unsignedBigInteger('gelombang')->nullable();
            $table->foreign('gelombang')
                ->references('id')
                ->on('jadwal_kegiatan')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('tahun_masuk');

            $table->unsignedBigInteger('pil1')->nullable();
            $table->foreign('pil1')
                ->references('id')
                ->on('divisi')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pil2')->nullable();
            $table->foreign('pil2')
                ->references('id')
                ->on('divisi')
                ->onUpdate('cascade')->onDelete('cascade');



            $table->string('status_pendaftaran');
            $table->datetime('tgl_pendaftaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
