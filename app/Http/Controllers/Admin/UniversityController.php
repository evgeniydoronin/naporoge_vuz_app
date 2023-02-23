<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityStoreRequest;
use App\Models\Group;
use App\Models\University;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $universities = University::all()->sortDesc();
        $groups = Group::whereBelongsTo($universities)->get();

        return view('admin.universities.index', compact('universities', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversityStoreRequest $request)
    {
        $validatedData = $request->validated();

        University::create($validatedData);

        return to_route('universities.index')->with('status', 'Университет успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        $groups = University::find($university->id)->groups;
        return view('admin.universities.edit', compact('university', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversityStoreRequest $request, University $university): RedirectResponse
    {
        $university->update($request->validated());

        return to_route('universities.index')->with('status', 'Университет обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
