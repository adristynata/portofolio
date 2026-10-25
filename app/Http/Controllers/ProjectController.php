<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use HandlesImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('dashboard.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:20480',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_link' => 'nullable|string|max:255',
            'demo_link' => 'nullable|string|max:255',
        ], [
            'image.required' => 'Gambar proyek wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus berupa jpeg, png, jpg, gif, webp, atau svg.',
            'image.max' => 'Ukuran gambar maksimal adalah 20MB.',
            'title.required' => 'Judul proyek wajib diisi.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
        ]);

        $data = $request->only(['title', 'description', 'github_link', 'demo_link']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'projects');
            if (str_starts_with($data['image'], 'data:')) {
                $this->ensureColumnSupportsBase64('projects', 'image');
            }
        }

        Project::create($data);

        return redirect()->route('project.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:20480',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_link' => 'nullable|string|max:255',
            'demo_link' => 'nullable|string|max:255',
        ], [
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus berupa jpeg, png, jpg, gif, webp, atau svg.',
            'image.max' => 'Ukuran gambar maksimal adalah 20MB.',
            'title.required' => 'Judul proyek wajib diisi.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
        ]);

        $data = $request->only(['title', 'description', 'github_link', 'demo_link']);

        if ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'data:')) {
                try {
                    Storage::disk('public')->delete($project->image);
                } catch (\Throwable $e) {}
            }
            $data['image'] = $this->storeImage($request->file('image'), 'projects');
            if (str_starts_with($data['image'], 'data:')) {
                $this->ensureColumnSupportsBase64('projects', 'image');
            }
        }

        $project->update($data);

        return redirect()->route('project.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        if ($project->image && !str_starts_with($project->image, 'data:')) {
            try {
                Storage::disk('public')->delete($project->image);
            } catch (\Throwable $e) {}
        }
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Proyek berhasil dihapus!');
    }
}