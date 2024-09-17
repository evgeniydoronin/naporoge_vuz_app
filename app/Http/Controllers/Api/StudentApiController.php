<?php

namespace App\Http\Controllers\Api;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentApiController extends Controller
{
  public function index(): array
  {
    return ['student' => '1'];
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): array
  {

    $data = $request->all();
    $phoneNumber = $data['phone'];
    $authCode = $data['authCode'];
    $fcmToken = $data['fcmToken'];
    $timeZoneName = $data['timeZoneName'];

    $user = User::create([
      'role' => Role::Student,
      'password' => Hash::make('123456')
    ]);

    Student::create([
      'user_id' => $user->id,
      'phone' => $phoneNumber,
    ]);

    /// Create user token
    if (!empty($fcmToken)) {
      $token = FcmToken::create([
        'user_id' => $user->id,
        'token' => $fcmToken,
        'timezone' => $timeZoneName,
      ]);
    }


    event(new Registered($user));

    // deactivate authCode
    $authCodeRow = DB::table('codes')
      ->where('code', '=', $authCode)
      ->update(['is_activated' => 1, 'user_id' => $user->id]);

    return ['student' => $user, 'authCode' => $authCodeRow, 'token' => !empty($token) ? $token->token : null];
  }

  public function getStudent(Request $request) : array
  {
    $data = $request->all();
    $phone = $data['phone'];

    $student = DB::table('students')
      ->where('phone', '=', $phone)
      ->get();


    return ['student' => $student];
  }

  public function updateToken(Request $request): array
  {
    $data = $request->all();

    $user_id = $data['user_id'];
    $fcmToken = $data['fcmToken'];

    // Проверка существования записи
    $exists = DB::table('fcm_tokens')->where('user_id', '=', $user_id)->exists();

    if (!$exists) {
      // Запись не найдена, можно выбросить исключение или вернуть ошибку
      return ['error' => 'User token not found'];
    }

    // Обновление токена
    DB::table('fcm_tokens')
      ->where('user_id', '=', $user_id)
      ->update(['token' => $fcmToken]);

    // Повторное получение обновлённой записи для возврата
    $updatedUserToken = DB::table('fcm_tokens')->where('user_id', '=', $user_id)->first();

    return ['new_token' => $updatedUserToken];
  }
}
