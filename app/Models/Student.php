<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  // Указываем, что primaryKey это user_id, а не id
  protected $primaryKey = 'user_id';

  // Указываем, что primaryKey не автоинкрементный
  public $incrementing = false;

  // Указываем тип данных primaryKey
  protected $keyType = 'bigint';

  protected $fillable = [
    'user_id',
    'is_verified',
    'active_stream_id',
    'phone',
    'attestation',
    'last_active_at'
  ];
}
