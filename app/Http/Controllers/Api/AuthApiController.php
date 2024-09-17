<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthApiController extends Controller
{
  public function index(): array
  {
    return ['code' => '1234'];
  }

  public function sendSmsCode(Request $request): array
  {
    $data = $request->all();
    $phoneNumber = $data['phone'];
    // generate sms confirm code
    $code = mt_rand(1000, 9999);

    $ch = curl_init("https://sms.ru/sms/send");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
      /// PROD
       "api_id" => "B42D5BA2-D015-2884-5FE2-30AF845FABCD",

      /// DEV
//      "api_id" => "82E2E443-BAC7-CBFE-3EA8-9809B1D10090",

      "to" => $phoneNumber, // До 100 штук до раз 9017792937
      "msg" => $code, // Если приходят крякозябры, то уберите iconv и оставьте только "Привет!",
      "json" => 1 // Для получения более развернутого ответа от сервера
    )));
    $body = curl_exec($ch);
    curl_close($ch);


    return ['sms_ru' => json_decode($body), 'code' => $code];
//    return ['code' => $code];
  }
  public function confirmAuthCode(Request $request): array
  {
    $data = $request->all();
    $code = $data['authCode'];

    $authCodes = DB::table('codes')
      ->where('is_activated', false)
      ->where('code', '=', $code)
      ->get();

    return ['authCode' => $authCodes];
  }


}


