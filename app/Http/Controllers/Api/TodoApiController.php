<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoApiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return ['todos' => Todo::all()];
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = $request->all();

//      return ['from server' => $data];

    $todo = Todo::create([
      'user_id' => $data['user_id'],
      'parent_id' => $data['parent_id'],
      'title' => $data['title'],
      'category' => $data['category'],
      'order' => $data['order'],
      'is_checked' => $data['is_checked'],
    ]);

    return $todo;
  }

  /**
   * Display the specified resource.
   */
  public function show(Todo $todo)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Todo $todo)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $data = $request->all();

    $todo = Todo::find($data['id']);

    if (isset($data['title'])) {
      $todo->title = $data['title'];
    }
    if (isset($data['category'])) {
      $todo->category = $data['category'];
    }
    if (isset($data['order'])) {
      $todo->order = $data['order'];
    }
    if (isset($data['is_checked'])) {
      $todo->is_checked = $data['is_checked'];
    }

    $todo->save();

    $todo['is_checked'] = $todo['is_checked'] == 1;

    return $todo;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    $data = $request->all();

    $todo = Todo::find($data['id']);
    $todo->delete();

    $rawSubTodos = DB::table('todos')->whereNotNull('parent_id')->get();

    $subTodos = [];

    if (!empty($rawSubTodos)) {
      foreach ($rawSubTodos as $rawTodo) {
        if ($rawTodo->parent_id == $todo->id) {
          $subTodos[] = $rawTodo;
        }
      }
    }

    if (!empty($subTodos)) {
      foreach ($subTodos as $t) {
        $subTodo = Todo::find($t->id);
        $subTodo->delete();
      }
    }

    return ['todo' => $todo, 'subTodos' => !empty($subTodos) ? $subTodos : []];
  }

  public function getTodos(Request $request): array
  {
    $data = $request->all();
    $user_id = $data['user_id'];

    $todos = DB::table('todos')
      ->where('user_id', '=', $user_id)
      ->get();

    if (!empty($todos)) {
      foreach ($todos as $key => $todo) {
        $todo->is_checked = $todo->is_checked == 1;
        $todos[$key] = $todo;
      }
    }




    return ['todos' => $todos];
  }


}


