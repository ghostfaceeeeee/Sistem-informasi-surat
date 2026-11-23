<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['nama'];

    public function incomingLetters(): HasMany
    {
        return $this->hasMany(incomingLetter::class, 'category_id');
    }

    public function outgoingLetters(): HasMany
    {
        return $this->hasMany(OutGoingLetter::class, 'category_id');
    }
}

