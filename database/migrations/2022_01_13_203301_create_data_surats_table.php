<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_surats', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('slug')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('file_path')->nullable();
            $table->string('nomor_surat');
            $table->string('nama_surat');
            $table->text('disposisi')->nullable();
            $table->string('penerima');
            $table->string('pengirim');
            $table->tinyInteger('jenis_retensi');
            $table->date('tanggal_retensi')->nullable();
            $table->string('nomor_akuisisi');
            $table->date('tanggal_akuisisi')->nullable();
            $table->string('sumber_akuisisi')->nullable();
            // $table->tinyInteger('status_ketersediaan');
            // $table->foreignId('file_surat_id')->constrained('file_surats');
            // $table->foreignId('jenis_surat_id')->constrained('jenis_surats');
            $table->tinyInteger('access_level')->nullable();
            $table->timestamps();

        });

        // Schema::table('jenis_surats', function (Blueprint $table) {
        //     $table->bigInteger('jenis_surat_id')->unsigned();
        //     $table->foreign('jenis_surat_id')->references('id')->on('jenis_surats');            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_surats');
    }
}
