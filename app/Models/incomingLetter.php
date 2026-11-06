<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class incomingLetter extends Model
{
    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'pengirim',
        'perihal',
        'keterangan',
        
    ];
}
