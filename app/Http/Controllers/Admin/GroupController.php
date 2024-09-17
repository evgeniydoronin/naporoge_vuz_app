<?php

namespace App\Http\Controllers\Admin;

use App\Etc\ExportData;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupStoreRequest;
use App\Models\Code;
use App\Models\Group;
use App\Models\University;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Shuchkin\SimpleXLSXGen;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = Group::all()->sortDesc();
        $codes = Code::all();

        return view('admin.groups.index', compact('groups', 'codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('admin.groups.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $group = new Group($validatedData);

        $university = University::find($request->university);

        $university->groups()->save($group);

        return to_route('groups.index')->with('status', 'Группа успешно создана');
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
    public function edit(Group $group)
    {
        $universities = University::all();

        $current_university_id = $group->university->id;

        return view('admin.groups.edit', compact('group', 'universities', 'current_university_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupStoreRequest $request, Group $group): RedirectResponse
    {

        $university = University::find($request->university);

        $group->university()->associate($university);

        $group->update($request->validated());

        return to_route('groups.index')->with('status', 'Группа обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
