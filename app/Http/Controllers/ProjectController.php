<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Project::all();

        return view('pages.dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $slug = Project::generateSlug($validatedData['title']);

        $validatedData['slug'] = $slug;

        $newProject = Project::create($validatedData);

        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.dashboard.posts.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // $project = Project::findOrFail($id);
        return view('pages.dashboard.posts.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $slug = Project::generateSlug($validatedData['title']);

        $validatedData['slug'] = $slug;

        $project->update($validatedData);

        return redirect()->route('dashboard.posts.index')->with('success', 'Project successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('dashboard.posts.index')->with('success', 'Project successfully deleted');
    }
}
