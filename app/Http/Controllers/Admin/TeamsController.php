<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $teams = Team::sortable('name')->paginate();

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre de equipo debe ser obligatorio.',
            'name.unique' => 'Esta equipo ya existe',
        ];

        $data = $request->validate([
               'name' => 'required|unique:teams',
           ], $messages);

        Team::create($data);

        return redirect()->route('admin.teams.index')->with('flash', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Team $team)
    {
        $messages = [
            'name.required' => 'El nombre de equipo debe ser obligatorio.',
        ];

        $data = $request->validate([
           'name' => 'required|' . Rule::unique('teams')->ignore($team->id),
        ], $messages);

        $team->update($data);

        return redirect()->route('admin.teams.edit', $team)->with('flash', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return back()->with('flash', 'Registro borrado correctamente');
    }
}
