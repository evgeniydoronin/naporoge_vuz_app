<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{
    public function index(): View
    {
      $students = Student::all()->sortDesc();

        return view('admin.students.index',compact('students'));
    }

  public function updateStudents(Request $request)
  {
    // Валидация файла
    $request->validate([
      'fileStudentsImport' => 'required|mimes:xlsx,xls,csv',
    ]);

    // Проверка наличия файла
    if ($request->hasFile('fileStudentsImport')) {
      // Получение файла
      $file = $request->file('fileStudentsImport');

      // Сохранение файла в директорию storage/app/public/uploads
      $path = $file->store('public/uploads');

      // Формирование полного пути к файлу
      $fullPath = storage_path('app/public/' . $path);

      if (file_exists($fullPath)) {
//        Log::info('Starting import for file: ' . $fullPath);

        // Импорт данных из загруженного файла
        Excel::import(new StudentsImport, $fullPath);

//        Log::info('Import finished for file: ' . $fullPath);

        // Перенаправление обратно на страницу с сообщением об успехе
        return redirect()->back()->with('success', 'Данные студентов успешно обновлены');
      } else {
        // Перенаправление обратно на страницу с сообщением об ошибке
        return redirect()->back()->with('error', 'Файл не найден');
      }
    } else {
      // Перенаправление обратно на страницу с сообщением об ошибке
      return redirect()->back()->with('error', 'Файл не загружен');
    }
  }

}
