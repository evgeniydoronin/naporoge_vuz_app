<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TwoTargets;
use Illuminate\Http\Request;

class TwoTargetsApiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): array
  {
    $data = $request->all();

    $twoTargets = TwoTargets::find($data['id']);

    /// create
    if ($twoTargets === null) {
      $twoTargets = TwoTargets::create([
        'stream_id' => $data['stream_id'],
        'title' => !empty($data['title']) ? $data['title'] : '',
        'minimum' => !empty($data['minimum']) ? $data['minimum'] : '',
        'target_one_title' => !empty($data['target_one_title']) ? $data['target_one_title'] : '',
        'target_one_description' => !empty($data['target_one_description']) ? $data['target_one_description'] : '',
        'target_two_title' => !empty($data['target_two_title']) ? $data['target_two_title'] : '',
        'target_two_description' => !empty($data['target_two_description']) ? $data['target_two_description'] : '',
      ]);
    } /// update
    else {

      // stream_id
      $twoTargets->stream_id = $data['stream_id'];
      
      // title
      $twoTargets->title = $data['title'];

      // minimum
      $twoTargets->minimum = $data['minimum'];

      // target_one_title
      $twoTargets->target_one_title = $data['target_one_title'];

      // target_one_description
      $twoTargets->target_one_description = $data['target_one_description'];

      // target_two_title
      $twoTargets->target_two_title = $data['target_two_title'];

      // target_two_description
      $twoTargets->target_two_description = $data['target_two_description'];

      $twoTargets->save();

    }

    return ['twoTargets' => $twoTargets];
  }

  /**
   * Display the specified resource.
   */
  public function show(TwoTargets $twoTargets)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request): array
  {
    $data = $request->all();

//    return ['data' => $data];

    $target = TwoTargets::find($data['id']);

    // stream_id
    $target->stream_id = $data['stream_id'];

    // title
    $target->title = $data['title'];

    // minimum
    $target->minimum = $data['minimum'];

    // target_one_title
    $target->target_one_title = $data['target_one_title'];

    // target_one_description
    $target->target_one_description = $data['target_one_description'];

    // target_two_title
    $target->target_two_title = $data['target_two_title'];

    // target_two_description
    $target->target_two_description = $data['target_two_description'];

    $target->save();

    return ['twoTargets' => $target];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(TwoTargets $twoTargets)
  {
    //
  }
}
