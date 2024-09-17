<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Stream;
use App\Models\TwoTargets;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StreamApiController extends Controller
{
  public function index(): array
  {
    return ['streams' => Stream::all()];
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): array
  {

    $validated = $request->validate([
      'start_at' => ['nullable', 'date_format:Y-m-d'],
    ]);

    $data = $request->all();


    $user_id = $data['user_id'];
    $start_at = $data['start_at'];
    $course_id = $data['course_id'];
    $title = $data['title'];
    $weeks = $data['weeks'];
    $is_active = $data['is_active'];


    // Деактивируем предыдущий курс

    $previous_stream = null;
    if (isset($data['old_stream_id'])) {

      // деактивируем предыдущий курс
      $old_stream = Stream::find($data['old_stream_id']);
      $old_stream->is_active = false;
      $old_stream->save();

      $previous_stream = $old_stream->id;
    }

    $stream = Stream::create([
      'user_id' => $user_id,
      'start_at' => $start_at,
      'is_active' => $is_active,
      'course_id' => $course_id,
      'weeks' => $weeks,
      'title' => $title,
    ]);

    return ['stream' => $stream, 'old_stream' => $previous_stream];
  }

  public function createNextStream(Request $request): array
  {

    $validated = $request->validate([
      'start_at' => ['nullable', 'date_format:Y-m-d'],
    ]);

    $data = $request->all();

    $user_id = $data['user_id'];
    $start_at = $data['start_at'];
    $old_stream_id = $data['old_stream_id'];
    $course_id = $data['course_id'];
    $title = $data['title'];
    $weeks = $data['weeks'];
    $is_active = $data['is_active'];

    // деактивируем предыдущий курс
    $old_stream = Stream::find($old_stream_id);
    $old_stream->is_active = false;
    $old_stream->save();

    // создаем новый курс

    $stream = Stream::create([
      'user_id' => $user_id,
      'start_at' => $start_at,
      'is_active' => $is_active,
      'course_id' => $course_id,
      'weeks' => $weeks,
      'title' => $title,
    ]);

    return ['stream' => $stream, 'old_stream' => $old_stream->id];
  }

  public function update(Request $request): array
  {
    $data = $request->all();

    $stream_id = $data['stream_id'];
    $stream = Stream::find($stream_id);
    // update stream date
    if (isset($data['start_at'])) {
      $stream->start_at = $data['start_at'];
    }
    // update stream weeks
    if (isset($data['weeks'])) {
      $stream->weeks = $data['weeks'];
    }
    // update stream title
    if (isset($data['title'])) {
      $stream->title = $data['title'];
    }
    // update stream description
    if (isset($data['description'])) {
      $stream->description = $data['description'];
    }
    // update stream course ID
    if (isset($data['course_id'])) {
      $stream->course_id = $data['course_id'];
    }

    $stream->save();


    return ['stream' => $stream];
  }

  public function expandStream(Request $request): array
  {
    $data = $request->all();

    $stream_id = $data['stream_id'];
    $stream = Stream::find($stream_id);
    // update stream weeks
    if (isset($data['weeks'])) {
      $stream->weeks = $data['weeks'];
    }

    $stream->save();


    return ['stream' => $stream];
  }

  public function createWeek(Request $request): array
  {
    $data = $request->all();

    $stream_id = $data['streamId'];
    $weekOfYear = $data['weekOfYear'];
    $year = $data['year'];
    $monday = $data['monday'];
    $cells = $data['cells'];


    // сначала создать с пустыми ячейками до создания дней
    $week = Week::create([
      'stream_id' => $stream_id,
      'number' => $weekOfYear,
      'year' => $year,
      'monday' => $monday,
      'cells' => [],
    ]);


    $newCells = [];
    $days = [];

    // если пришла создання пользователем неделя с днями
    if (!empty($cells)) {
      // update week system confirmed
      $week->user_confirmed = true;
      foreach ($cells as $key => $cell) {
        // {cellId: [2, 0, 4], startTime: 19:00},
        // {cellId: [2, 0, 3], startTime: 19:00},
        // {cellId: [2, 0, 2], startTime: 19:00},
        // {cellId: [2, 0, 1], startTime: 19:00},
        // {cellId: [2, 0, 0], startTime: 19:00},
        // {cellId: [0, 0, 6], startTime: 19:00},
        // {cellId: [2, 5, 5], startTime: 0:00},
        // {cellId: [0, 0, 6], startTime: 0:00}
        $cellStartTime = $cell['startTime'];
        $plusDays = $cell['cellId'][2]; // [0,1,2,3,4,5,6]
        $startDate = Carbon::parse($monday)->addDays($plusDays)->format('Y-m-d');
        $startDateTime = Carbon::parse("$startDate $cellStartTime")->format('Y-m-d H:i');

        $day = Day::create([
          'week_id' => $week->id,
          'start_at' => $startDateTime,
          'date_at' => $startDate,
        ]);

        $newCells[] = ["dayId" => $day->id, "cellId" => $cell['cellId']];

        $days[$key]['day'] = $day;
      }
    }
    // пришел запрос от системы на создание недели
    // входящих данных дней нет
    else {
      // update week system confirmed
      $week->system_confirmed = true;

      for ($i = 0; $i < 7; $i++) {
        $day = Day::create([
          'week_id' => $week->id,
          'date_at' => Carbon::parse($monday)->addDays($i)->format('Y-m-d'),
        ]);

        $newCells[] = ["dayId" => $day->id, "cellId" => [0, 0, $i]];

        $days[$i]['day'] = $day;
      }
    }


    // $cells = [{"dayId": 949, "cellId": [0, 0, 5]}, {"dayId": 950, "cellId": [0, 0, 4]}, {"dayId": 951, "cellId": [0, 0, 2]}, {"dayId": 952, "cellId": [0, 0, 0]}, {"dayId": 953, "cellId": [0, 0, 3]}, {"dayId": 954, "cellId": [0, 0, 1]}, {"dayId": 955, "cellId": [0, 0, 6]}]

    $week->cells = $newCells;
    $week->save();

    return ['week' => $week, 'days' => $days];

  }

  public function updateWeek(Request $request): array
  {
    $data = $request->all();


    $newCells = [];
    $days = [];

    $week_id = $data['week_id'];
    $cells = $data['cells'];

    $week = Week::find($week_id);
    // update week user confirmed
    $week->user_confirmed = true;


    foreach ($cells as $key => $cell) {
      // приходит
      // dayId: 950, cellId: [2, 0, 4], startTime: 19:00
      // добавляем только
      // dayId: 950, cellId: [2, 0, 4]
      $newCells[$key] = ["dayId" => $cell['dayId'], "cellId" => $cell['cellId']];

      // Находим день
      $day = Day::find($cell['dayId']);
      // {id: 949, week_id: 215, start_at: 2023-08-05 19:00, completed_at: null}
      // отделяем дату от старого времени
      $dayDate = Carbon::parse($day->start_at)->format('Y-m-d');
      // добавляем дню новое время
      $newDateTimeString = "$dayDate {$cell['startTime']}";

      $day->start_at = Carbon::parse($newDateTimeString)->format('Y-m-d H:i');

      $day->save();

      $days[$key]['day'] = $day;

      //      $startTime = $cell['startTime'];
//      $plusDays = $cell['id'][2];
//      $startDate = Carbon::parse($stream->start_at)->addDays($plusDays)->addHour(explode(':', $startTime)[0])->addMinute(explode(':', $startTime)[1])->format('Y-m-d H:i');

//      $day = Day::create([
//        'week_id' => $week->id,
//        'start_at' => $startDate,
//      ]);


//      $days[$key]['day'] = $day;
    }

//    return ['newCells' => $newCells];

    $week->cells = $newCells;
    $week->save();

    return ['week' => $week, 'newCells' => $newCells, 'days' => $days];
  }

  public function updateWeekProgress(Request $request): array
  {
    $data = $request->all();

    $week_id = $data['week_id'];
    $week_progress = $data['week_progress'];

    $week = Week::find($week_id);
    // update week progress
    $week->progress = $week_progress;
    $week->save();

    return ['week' => $week];

  }

  public function deleteDuplicates(Request $request): array
  {
    $data = $request->all();
    $weeksIdForDelete = $data['weeksIdForDelete'];
    $daysIdForDelete = $data['daysIdForDelete'];

    if (count($weeksIdForDelete) > 0) {
      foreach ($weeksIdForDelete as $week_id) {
        $week = Week::find($week_id);
        if (!is_null($week)) {
          $week->delete();
        }
      }

      foreach ($daysIdForDelete as $day_id) {
        $day = Day::find($day_id);
        if (!is_null($day)) {
          $day->delete();
        }
      }

      return ['status' => 'success', 'data' => $data];
    } else {
      return ['status' => 'empty', 'data' => $data];
    }

  }

  public function deleteStream(Request $request): array
  {
    $data = $request->all();

    $stream_id = $data['stream_id'];
    $stream = Stream::find($stream_id);
    $stream->delete();

    return ['stream' => $stream];
  }

  public function deactivateStream(Request $request): array
  {
    $data = $request->all();

    $stream_id = $data['stream_id'];
    $stream = Stream::find($stream_id);
    $stream->is_active = false;
    $stream->save();

    return ['stream' => $stream];
  }

  public function getStudentStreams(Request $request): array
  {
    $data = $request->all();
    $user_id = $data['user_id'];

    $streams = DB::table('streams')
      ->where('user_id', '=', $user_id)
      ->get();

    return ['streams' => $streams];
  }

  public function getStudentWeeks(Request $request): array
  {
    $data = $request->all();

    $streamsIds = json_decode($data['streamsIds']);

    $weeks = DB::table('weeks')
      ->whereIn('stream_id',  $streamsIds)->get();

    return ['weeks' => $weeks];

  }

  public function getStudentDays(Request $request): array
  {
    $data = $request->all();

    $weeksIds = json_decode($data['weeksIds']);

    $days = DB::table('days')
      ->whereIn('week_id',  $weeksIds)->get();

    return ['days' => $days];

  }

  public function getStudentDaysResults(Request $request): array
  {
    $data = $request->all();

    $daysIds = json_decode($data['daysIds']);

    $daysResults = DB::table('day_results')
      ->whereIn('day_id',  $daysIds)->get();

    return ['daysResults' => $daysResults];

  }

  public function getStudentDiaryNotes(Request $request): array
  {
    $data = $request->all();

    $diaryNotes = DB::table('diary_notes')
      ->where('user_id',  $data['userId'])->get();

    return ['diaryNotes' => $diaryNotes];

  }

  public function getStudentTwoTargets(Request $request): array
  {
    $data = $request->all();

    $streamsIds = json_decode($data['streamsIds']);

    // активный курс
    $stream = DB::table('streams')->whereIn('id', $streamsIds)->where('is_active', true)->get()->all();

    $twoTargets = null;

    if (!empty($stream)) {
          $twoTargets = DB::table('two_targets')
      ->where('stream_id',  $stream[0]->id)->get();
    }


    return ['twoTargets' => $twoTargets];

  }
}
