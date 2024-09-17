<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TheoryApiController extends Controller
{
  public function index(): array
  {
    $theories = Theory::all();

    return ['theories' => $theories];
  }
}
