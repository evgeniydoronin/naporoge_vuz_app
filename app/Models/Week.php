<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Week extends Model
{
    use HasFactory;

  protected $fillable = [
    'stream_id',
    'number',
    'year',
    'monday',
    'progress',
    'system_confirmed',
    'user_confirmed',
    'cells',
  ];

  public $timestamps = false;

  public function days(): HasMany
  {
    return $this->hasMany(Day::class);
  }

  public function stream(): BelongsTo
  {
    return $this->belongsTo(Stream::class);
  }

  protected $casts = [
    'cells' => 'array'
  ];
}
