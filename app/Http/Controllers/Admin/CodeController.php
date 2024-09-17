<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Group;
use App\Models\University;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $codes = Code::all()->sortDesc();

        return view('admin.codes.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $universities = University::all();

        return view('admin.codes.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'group_id' => ['required'],
            'university_id' => ['required'],
            'code' => ['required'],
        ]);

        for ($i = 0; $i < $request->code; $i++) {
            $bytes = random_bytes(3);
            $code = bin2hex($bytes);

            Code::create([
                'group_id' => $request->group_id,
                'university_id' => $request->university_id,
                'code' => $code,
            ]);
        }

        return to_route('codes.index')->with('status', 'Коды успешно созданы');
    }

    /**
     * Display the specified resource.
     */
    public function show(Code $code): Response
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }

    public function getGroupsByUniversity(string $id): JsonResponse
    {
        $groups = University::find($id)->groups;

        return response()->json($groups);
    }
}
