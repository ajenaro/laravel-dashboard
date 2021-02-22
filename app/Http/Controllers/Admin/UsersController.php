<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\{Profession, Team, User, Skill};
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {

        //return $request->input('skills');

        $users = User::query()
            ->search(request('search'))
            ->with(['profile', 'skills', 'team', 'profile.profession'])
            ->sortable()
            ->OrderByDesc('created_at')
            ->paginate();

        return view('admin.users.index',[
            'users' => $users,
            'skills' => Skill::orderBy('name')->get(),
            'checkedSkills' => collect(request('skills')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $user = new User();

        return view('admin.users.create', [
            'user' => $user,
            'showStatus' => false,
            'teams' => Team::orderBy('name')->get(),
            'skills' => Skill::orderBy('name')->get(),
            'professions' => Profession::orderBy('title')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect('/admin/users'.$_COOKIE['pageurl'])->with('flash', 'Usuario agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     */
    public function show(User $user)
    {
        return view('admin.users.show',
                    compact('user')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user' => $user,
            'showStatus' => true,
            'teams' => Team::orderBy('name')->get(),
            'skills' => Skill::orderBy('name')->get(),
            'professions' => Profession::orderBy('title')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('admin.users.edit', $user)->with('flash', 'Usuario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('flash', 'Usuario eliminado correctamente');
    }
}
