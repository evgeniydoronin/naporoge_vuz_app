<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaryNote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','note','created_at', 'updated_at'];

    public $timestamps = false;
}
