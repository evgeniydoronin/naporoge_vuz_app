<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'parent_id',
    'title',
    'category',
    'order',
    'is_checked',
  ];

  public $timestamps = false;
}
