<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'timezone',
        'comment'
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function codes(): HasMany
    {
        return $this->hasMany(Code::class);
    }
}
