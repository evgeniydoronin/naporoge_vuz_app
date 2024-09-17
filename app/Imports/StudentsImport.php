<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use App\Models\Code;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StudentsImport implements ToCollection, WithHeadingRow
{
  public function collection(Collection $rows)
  {

    foreach ($rows as $row) {

      $code = Code::where('code', $row['code'])->first();

      if ($code && $code->user_id) {
        $user = User::find($code->user_id);

        if ($user) {
          // Обновление имени пользователя

          $user->name = $row['name'];
          $user->save();

          // Обновление аттестации
          $student = Student::where('user_id', $user->id)->first();
          if ($student) {
            Log::info('Updating student attestation for user_id ' . $user->id);
            $student->attestation = $row['attestation'];
            $student->save();
          } else {
            Log::warning('Student record not found for user_id ' . $user->id);
          }
        }
      }
    }
  }
}
