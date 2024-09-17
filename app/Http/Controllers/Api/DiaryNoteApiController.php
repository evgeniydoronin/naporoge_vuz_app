<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiaryNote;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiaryNoteApiController extends Controller
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
  public function store(Request $request)
  {
    $data = $request->all();

    $note = DiaryNote::create([
      'user_id' => $data['user_id'],
      'note' => $data['note'],
      'created_at' => $data['created_at'],
      'updated_at' => $data['updated_at'],
    ]);

    // обновляем последнюю активность студента
    $student = Student::where('user_id', $data['user_id'])->first();
    $student->last_active_at = Carbon::now();
    $student->save();

    return ['note' => $note];
  }

  /**
   * Display the specified resource.
   */
  public function show(DiaryNote $diaryNote)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, DiaryNote $diaryNote): array
  {
    // {"id":40,"note":"new note user 321"}
    // {'id': note.id, 'note': '12234'}
    $data = $request->all();

    $diaryNote = DiaryNote::find($data['id']);
    $diaryNote['note'] = $data['note'];
    $diaryNote->save();

    // обновляем последнюю активность студента
    $student = Student::where('user_id', $data['user_id'])->first();
    $student->last_active_at = Carbon::now();
    $student->save();

    return ['note' => $diaryNote];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, DiaryNote $diaryNote)
  {
    $data = $request->all();

    $diaryNote = DiaryNote::find($data['id']);
    $diaryNote->delete();

    return ['message' => 'success', 'note_id' => $data['id']];
  }
}
