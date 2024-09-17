<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

  protected $fillable = [
    'course_id',
    'user_id',
    'start_at',
    'weeks',
    'title',
    'description',
    'is_active',
    'target_minimum',
    'target_external_key',
    'target_external_value',
    'target_internal_key',
    'target_internal_value',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function weeksRelations()
  {
    return $this->hasMany(Week::class);
  }

  public function setStartAtAttribute($value)
  {
    $this->attributes['start_at'] = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
  }

  public function getStartAtAttribute()
  {
    return Carbon::createFromFormat('Y-m-d', $this->attributes['start_at'])->format('Y-m-d');
  }
}
