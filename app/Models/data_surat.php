<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\file_surat;

class data_surat extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id',
        'file',
        'nama_file',
        'file_path',
        'nama_surat',
        'disposisi',
        'penerima',
        'pengirim',
        'jenis_retensi',
        'tanggal_retensi',
        'nomor_akuisisi',
        'tanggal_akuisisi',
        'sumber_akuisisi',
        'access_level'];

    // public function fileSurat() {
    //     return $this->hasOne(file_surat::class);
    // }
}
