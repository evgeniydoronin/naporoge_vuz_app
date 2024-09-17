<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TheoryController extends Controller
{
  public function index(): View
  {
    $theories = Theory::all()->sortDesc();

    return view('admin.theories.index', compact('theories'));
  }

  public function edit(Theory $theory)
  {
    $theory = Theory::find($theory->id);
    return view('admin.theories.edit', compact('theory', 'theory'));
  }

  public function update(Request $request, $id)
  {

    $request->validate([
      'title' => 'required|max:255',
      'content' => 'required',
      'pdf_path' => ['nullable', 'mimes:pdf', 'max:50000'],
    ]);

    $pdfPath = null;
    if ($request->hasFile('pdf_path')) {
      $pdfPath = $request->file('pdf_path')->storeAs(
        'theory_pdf',
        $request->file('pdf_path')->getClientOriginalName(),
        'public');

      $request->file('pdf_path')->move(public_path('storage/theory_pdf'), $request->file('pdf_path')->getClientOriginalName());
    }

    $data = $request->all();

    $theory = Theory::find($id);

    $theory->update([
      'title' => $data['title'],
      'content' => $data['content'],
    ]);

    if ($pdfPath != null) {
      $theory->update([
        'pdf_path' =>  $pdfPath
      ]);
    }

    return to_route('theories.index')->with('status', 'Текст обновлен');
  }
}
