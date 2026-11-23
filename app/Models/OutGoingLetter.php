<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutGoingLetter extends Model
{
	protected $fillable = [
		'nomor_surat',
		'tanggal',
		'penerima',
		'perihal',
		'keterangan',
		'category_id',
		'lampiran',
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id');
	}
}
