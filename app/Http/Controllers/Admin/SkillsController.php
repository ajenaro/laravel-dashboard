<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('admin.skills.index', [
            'skills' => Skill::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $skill = new Skill();

        return view('admin.skills.create', compact('skill'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:skills',
            ]
        );

        Skill::create($data);

        return redirect()->route('admin.skills.index')->with('flash', 'Habilidad creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $skill
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit',[
            'skill' => $skill,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return back()->with('flash', 'Habilidad eliminada correctamente');
    }
}
