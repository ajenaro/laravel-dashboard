<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $skills = Skill::sortable('name')->paginate();

        return view('admin.skills.index', compact('skills'));
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

        return redirect()->route('admin.skills.index')->with('flash', 'Registro creado correctamente');
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
     * @param \Illuminate\Http\Request $request
     * @param Skill $skill
     */
    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate(
            [
                'name' => 'required|' . Rule::unique('skills')->ignore($skill->id),
            ]
        );

        $skill->update($data);

        return redirect()->route('admin.skills.edit', $skill)->with('flash', 'Registro actualizado correctamente');
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
