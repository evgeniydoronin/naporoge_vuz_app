<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Day;
use App\Models\Group;
use App\Models\University;
use App\Models\Week;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExportStudentsController extends Controller
{
  public function index(): View
  {
    $universities = University::all();
    return view('admin.exports.index', compact('universities'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    // Получить все входящие данные запроса
    $input = $request->all();

    // Инициализируем пустой массив для ID групп
    $groupIds = [];

    // Проходим по всем элементам входящих данных
    foreach ($input as $key => $value) {
      // Проверяем, начинается ли ключ с "group_id_"
      if (str_starts_with($key, 'group_id_') && $value === 'on') {
        // Извлекаем числовое значение из ключа
        $groupId = intval(str_replace('group_id_', '', $key));
        // Добавляем ID группы в массив
        $groupIds[] = $groupId;
      }
    }

    // Теперь $groupIds содержит все ID групп
    // Инициализируем массив для хранения данных групп
    $groupsData = [];

    // ID пользователя, курс которого мы ищем
    $targetUserId = 381;
    $firstCourse = null;

    /// на примере пользователя 375
    // 1. Найти группу по ID
    // 2. По ID группы найти все авторизационнае коды в таблице codes
    // 3. Собрать всех пользователей этой группы,
    // 4. Найти курс пользователя, для этого нужно проверить
    // дату старта группы и дату старта курса пользователя, они должны совпадать
    // потому что у пользователя могут быть и более новые/старые курсы
    // 5. Найти недели курса
    // 6. Найти дни недель
    // 7. Найти результаты дней
    // 8. Обработать данные для результата таблицы
    // Данные для таблицы :
    /// Код |
    /// Учебное заведение (текст) |
    /// Ведущий (текст) /1, несколько, все |
    /// Группа (текст)/ 1, несколько, все |
    /// Дата Потока / конкретная |
    /// Телефон |
    /// Имя (текст) \ дважды не загружает - проверка на дубликаты. / Обновление |
    /// Дата старта реальная |
    /// Кол-во выполнений за неделю 1 |
    /// Кол-во выполнений за неделю 2 |
    /// Кол-во выполнений за неделю 3 |
    /// Всего выполнено |
    /// Итоговая оценка

    // Если массив ID групп не пустой
    if (!empty($groupIds)) {
      foreach ($groupIds as $groupId) {
        // Найти группу по ID
        $group = Group::find($groupId);

        // Если группа найдена
        if ($group) {
          // Найти всех пользователей этой группы через коды
          $users = $group->codes->pluck('user')->unique('id');

          // Собрать данные для каждого пользователя
          foreach ($users as $user) {
            if ($user != null) {
              // Найти поток пользователя, где дата старта потока совпадает с датой старта группы
              $stream = $user->streams()->where('start_at', $group->getRawOriginal('start_at'))->first();

              if ($stream) {
                // Предполагаем, что у потока есть связанные недели и дни
                $weeks = $stream->weeksRelations; // Не забывайте, что для этого метода нужна связь weeks в модели Stream
                $results = [];

                if ($weeks != null) {
                  foreach ($weeks as $week) {
                    $days = $week->days; // Не забывайте, что для этого метода нужна связь days в модели Week
                    foreach ($days as $day) {
                      $dayResults = $day->dayRelResults; // Не забывайте, что для этого метода нужна связь results в модели Day
                      $results = array_merge($results, $dayResults->toArray());
                    }
                  }
                }

                $realStartDate = $this->findRealStartDate($stream->id);
                $completedDaysPerWeek = $this->calculateCompletedDaysPerWeek($stream->id);
                $totalWeeksResults = array_sum($completedDaysPerWeek);
                $finalScore = $this->calculateFinalScore($totalWeeksResults);

                // Сформировать данные для результата таблицы
                $groupData = [
                  'stream 555' => $stream,
                  'stream ID' => $stream->id,
                  'weeks 555' => $weeks,
                  'days 555' => !empty($days) ? $days : null,
                  'dayResults' => $results
//                'code' => $group->codes->where('user_id', $user->id)->first()->code, // Код пользователя
//                'university' => $group->university->name,
//                'teacher' => $group->teachers,
//                'group' => $group->name,
//                'start_date' => $group->start_at,
//                'phone' => $user->phone,
//                'name' => $user->name,
//                'real_start_date' => $user->real_start_date, // Предполагаем, что у пользователя есть поле 'real_start_date'
//                'week_1_results' => $this->calculateResultsForWeek($results, 1),
//                'week_2_results' => $this->calculateResultsForWeek($results, 2),
//                'week_3_results' => $this->calculateResultsForWeek($results, 3),
//                'total_results' => count($results),
//                'final_score' => $this->calculateFinalScore($results)
                ];

                // Добавить данные в массив
                $groupsData[] = $groupData;

                // Проверяем, если это целевой пользователь и курс еще не установлен
                if ($user->id == $targetUserId && !$firstCourse) {
                  $firstCourse['code'] = $group->codes->where('user_id', $user->id)->first()->code;
                  $firstCourse['university'] = $group->university->name;
                  $firstCourse['teacher'] = $group->teachers;
                  $firstCourse['group'] = $group->name;
                  $firstCourse['start_at'] = $group->start_at;
                  $firstCourse['user_phone'] = $user->student->phone;
                  $firstCourse['user_name'] = $user->name;
                  $firstCourse['real_start_date'] = $realStartDate;
                  $firstCourse['completed_days_week_1'] = $completedDaysPerWeek[0];
                  $firstCourse['completed_days_week_2'] = $completedDaysPerWeek[1];
                  $firstCourse['completed_days_week_3'] = $completedDaysPerWeek[2];
                  $firstCourse['total_weeks_results'] = $totalWeeksResults;
                  $firstCourse['final_score'] = $finalScore;
                }
              }
            }
          }
        }
      }

      // Пример вывода массива для отладки
      dd($firstCourse);
    }

    // Возвращаем ответ или редиректим пользователя
    return redirect()->route('some.route')->with('success', 'Данные успешно обработаны');
  }

  /// Вспомогательные методы для вычислений

  // Метод для поиска реальной даты старта курса
  protected function findRealStartDate($streamId)
  {
    $realStartDate = Day::whereHas('week', function($query) use ($streamId) {
      $query->where('stream_id', $streamId);
    })->whereNotNull('completed_at')
      ->orderBy('completed_at', 'asc')
      ->first();

    return $realStartDate ? $realStartDate->completed_at : null;
  }

  // Метод для подсчета количества выполненных дней по неделям
  protected function calculateCompletedDaysPerWeek($streamId): array
  {
    $completedDays = [0, 0, 0];

    $weeks = Week::where('stream_id', $streamId)->orderBy('number', 'asc')->get();

    foreach ($weeks as $index => $week) {
      $days = $week->days;
      foreach ($days as $day) {
        if ($day->completed_at !== null) {
          $completedDays[$index]++;
        }
      }
    }

    return $completedDays;
  }

  // Метод для вычисления итоговой оценки
  protected function calculateFinalScore($totalWeeksResults): string
  {
    if ($totalWeeksResults <= 10) {
      return 'Плохо';
    } elseif ($totalWeeksResults >= 11 && $totalWeeksResults <= 15) {
      return 'Хорошо';
    } else {
      return 'Отлично';
    }
  }

  public function getDatesByUniversity(string $id): JsonResponse
  {
    $groups = University::find($id)->groups;

    return response()->json($groups);
  }
}
