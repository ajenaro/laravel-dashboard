<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tags = Tag::sortable('name')->paginate();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $tag = new Tag();

        return view('admin.tags.create', [
            'tag' => $tag,
            'showUrl' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre de etiqueta debe ser obligatorio.',
            'name.unique' => 'Esta etiqueta ya existe',
        ];

        $data = $request->validate([
               'name' => 'required|unique:tags',
           ], $messages);

        Tag::create($data);

        return redirect()->route('admin.tags.index')->with('flash', 'Registro creado correctamente');
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
     * @param Tag $tag
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', [
            'tag' => $tag,
            'showUrl' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Tag $tag
     */
    public function update(Request $request, Tag $tag)
    {
        $messages = [
            'name.required' => 'El nombre de etiqueta debe ser obligatorio.',
        ];

        $data = $request->validate([
           'name' => 'required|' . Rule::unique('tags')->ignore($tag->id),
        ], $messages);

        $tag->update($data);

        return redirect()->route('admin.tags.edit', $tag)->with('flash', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
