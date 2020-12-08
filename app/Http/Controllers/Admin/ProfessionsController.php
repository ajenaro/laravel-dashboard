<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kyslik\ColumnSortable\Sortable;

class ProfessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $professions = Profession::sortable('title')->paginate();

        return view('admin.professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $profession = new Profession();

        return view('admin.professions.create', compact('profession'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'La profesión debe ser obligatoria.',
            'title.unique' => 'Esta profesión ya existe',
        ];

        $data = $request->validate([
           'title' => 'required|unique:skills',
        ], $messages);

        Profession::create($data);

        return redirect()->route('admin.professions.index')->with('flash', 'Registro creado correctamente');
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
     * @param  int  $id
     */
    public function edit(Profession $profession)
    {
        return view('admin.professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Profession $profession
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Profession $profession)
    {
        $messages = [
            'title.required' => 'La profesión debe ser obligatoria.',
        ];

        $data = $request->validate([
           'title' => 'required|' . Rule::unique('professions')->ignore($profession->id),
        ], $messages);

        $profession->update($data);

        return redirect()->route('admin.professions.edit', $profession)->with('flash', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();

        return back()->with('flash', 'Profesión eliminada correctamente');
    }
}
