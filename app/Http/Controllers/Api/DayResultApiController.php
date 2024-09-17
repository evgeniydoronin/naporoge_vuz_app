<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\DayResult;
use App\Models\Stream;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use App\Models\Week;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class DayResultApiController extends Controller
{
  public function index(): array
  {
    return ['day' => Day::all()];
  }

  public function store(Request $request): array
  {
//    {
//"user_id":50,
//"day_id":526,
//"completed_at":"2023-07-04 00:25",
//"execution_scope":26,
//"result":"werwe",
//"desires":"large",
//"reluctance":"small",
//"interference":"2wew",
//"rejoice":"no",
//"timeSend":"2023-09-19 15:51:40.900490}"}
    $validated = $request->validate([
      'copmleted_at' => ['nullable', 'date_format:Y-m-d'],
    ]);

    $data = $request->all();


//    $timeSend = strtotime($data['timeSend']);

    // найти ВУЗ пользователя и определить его часовой пояс
    $user = User::find($data['user_id']);
    $user_code = $user->code;
    $user_university_id = $user['code']['university_id'];
    $university = University::find($user_university_id);

    $userTz = new DateTimeZone($university['timezone']);

    $serverTime = new DateTime('now', $userTz);
    $timeSend = new DateTime("{$data['timeSend']}", $userTz);
    $allowMinMinutes = new DateTime('now -2 minutes', $userTz);
    $allowMaxMinutes = new DateTime('now +2 minutes', $userTz);

    // даем интервал в 4 минуты на расхохжение с временем сервера
    if ($timeSend > $allowMinMinutes && $timeSend < $allowMaxMinutes) {
      // сохраняем день

      // day
      $day_id = $data['day_id'];
      $completed_at = $data['completed_at'];

      // day results
      $execution_scope = $data['execution_scope'];
      $result = $data['result'];
      $desires = $data['desires'];
      $reluctance = $data['reluctance'];
      $interference = $data['interference'];
      $rejoice = $data['rejoice'];


      // update completed time
      $day = Day::find($day_id);

      $day->completed_at = $completed_at;
      $day->save();

      $dayResult = DayResult::create([
        'day_id' => $day_id,
        'execution_scope' => $execution_scope,
        'result' => $result,
        'desires' => $desires,
        'reluctance' => $reluctance,
        'interference' => $interference,
        'rejoice' => $rejoice,
      ]);

      // обновляем последнюю активность студента
      $student = Student::where('user_id', $data['user_id'])->first();
      $student->last_active_at = Carbon::now();
      $student->save();

      return ['status' => true, 'day' => $day, 'day_result' => $dayResult, 'last_active_at' => $student->last_active_at];

    }
    // ошибка
    else {
//      return ['status' => false];
      // отключение проверки сохранения по времени
      if ($data['user_id'] == 121 ||
          $data['user_id'] == 64 || 
          $data['user_id'] == 581 || 
          $data['user_id'] == 600 ||
          $data['user_id'] == 593 ||
          $data['user_id'] == 599 ||
          $data['user_id'] == 601 ||
          $data['user_id'] == 608 ||
          $data['user_id'] == 609 ||
          $data['user_id'] == 630 ||
          $data['user_id'] == 632 ||
          $data['user_id'] == 653 ||
          $data['user_id'] == 610
      ) {
 
        // day
        $day_id = $data['day_id'];
        $completed_at = $data['completed_at'];

        // day results
        $execution_scope = $data['execution_scope'];
        $result = $data['result'];
        $desires = $data['desires'];
        $reluctance = $data['reluctance'];
        $interference = $data['interference'];
        $rejoice = $data['rejoice'];


        // update completed time
        $day = Day::find($day_id);

        $day->completed_at = $completed_at;
        $day->save();

        $dayResult = DayResult::create([
          'day_id' => $day_id,
          'execution_scope' => $execution_scope,
          'result' => $result,
          'desires' => $desires,
          'reluctance' => $reluctance,
          'interference' => $interference,
          'rejoice' => $rejoice,
        ]);

        // обновляем последнюю активность студента
        $student = Student::where('user_id', $data['user_id'])->first();
        $student->last_active_at = Carbon::now();
        $student->save();

        return ['status' => true, 'day' => $day, 'day_result' => $dayResult, 'last_active_at' => $student->last_active_at, 'student' => $student];

      } else {
        return ['status' => false];
      }
    }
  }
}
