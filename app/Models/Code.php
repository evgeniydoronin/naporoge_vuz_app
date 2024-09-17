<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{
  use HasFactory;

  protected $fillable = [
    'group_id',
    'university_id',
    'user_id',
    'code',
  ];

  public function group(): BelongsTo
  {
    return $this->belongsTo(Group::class);
  }

  public function university(): BelongsTo
  {
    return $this->belongsTo(University::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
