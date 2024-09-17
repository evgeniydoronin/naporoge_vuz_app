<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $managers = Manager::all()->sortDesc();

        return view('admin.managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string'],
            'email'    => ['required', 'string', 'email', 'unique:users'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => Role::Manager,
            'password' => Hash::make('123456')
        ]);

        Manager::create([
            'user_id'       => $user->id,
            'is_cleaner'    => $request->boolean('is_cleaner')
        ]);

        event(new Registered($user));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        Manager::where('user_id', $id)
               ->update(['is_cleaner' => $request->boolean('is_cleaner')]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}
