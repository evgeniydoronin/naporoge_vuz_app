<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoTargets extends Model
{
  use HasFactory;

  protected $fillable = [
    'stream_id',
    'title',
    'minimum',
    'target_one_title',
    'target_one_description',
    'target_two_title',
    'target_two_description',
  ];

  public $timestamps = false;

}
