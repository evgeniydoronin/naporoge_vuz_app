<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university_id',
        'description',
        'teachers',
        'start_at'
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function codes(): HasMany
    {
        return $this->hasMany(Code::class);
    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getStartAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['start_at'])->format('d-m-Y');
    }

}
