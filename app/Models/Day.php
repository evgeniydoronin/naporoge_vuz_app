<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Day extends Model
{
  use HasFactory;

  protected  $fillable = [
    'week_id',
    'date_at',
    'start_at',
    'completed_at',
  ];

  public $timestamps = false;

  protected $casts = [
    'date_at' => 'datetime',
    'start_at' => 'datetime',
    'completed_at' => 'datetime',
  ];

  public function dayRelResults()
  {
    return $this->hasMany(DayResult::class);
  }

  public function week(): BelongsTo
  {
    return $this->belongsTo(Week::class);
  }

//  public function setStartAtAttribute($value)
//  {
//    $this->attributes['start_at'] = Carbon::createFromFormat('Y-m-d H:i', $value)->format('Y-m-d H:i:s');
//  }
//  public function getStartAtAttribute()
//  {
//    return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['start_at'])->format('Y-m-d H:i');
//  }
//
//  public function setCompletedAtAttribute($value)
//  {
//    $this->attributes['completed_at'] = Carbon::createFromFormat('Y-m-d H:i', $value)->format('Y-m-d H:i');
//  }
//
//  public function getCompletedAtAttribute()
//  {
//    if ($this->attributes['completed_at'] == null) return null;
//
//    return Carbon::createFromFormat('Y-m-d H:i', $this->attributes['completed_at'])->format('Y-m-d H:i');
//  }
}
