<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutGoingLetter extends Model
{
	protected $fillable = [
		'nomor_surat',
		'tanggal',
		'penerima',
		'perihal',
		'keterangan',
	];
}
