<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:design,pdf,tutorial,certificate',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        try {
            $file = $request->file('file');
            $filePath = $file->store('projects/' . $request->category, 'public');

            Project::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'file_path' => $filePath,
                'original_filename' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
            ]);

            return redirect()->route('dashboard')->with('success', 'Project berhasil diupload!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload project: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        if ($project->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengedit project ini.');
        }

        $user = Auth::user();
        $projects = $user->projects()->latest()->get();

        return view('dashboard', ['projects' => $projects, 'editingProject' => $project]);
    }

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'category' => 'required|in:design,pdf,tutorial,certificate',
        'file' => 'nullable|file|max:10240', // file OPTIONAL saat edit
    ]);

    try {
        $project = Project::findOrFail($id);

        if ($project->user_id !== Auth::id()) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit project ini.');
        }

        // Jika user upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if (Storage::disk('public')->exists($project->file_path)) {
                Storage::disk('public')->delete($project->file_path);
            }

            // simpan file baru
            $file = $request->file('file');
            $filePath = $file->store('projects/' . $request->category, 'public');

            $project->file_path = $filePath;
            $project->original_filename = $file->getClientOriginalName();
            $project->file_size = $file->getSize();
        }

        // update data lainnya
        $project->title = $request->title;
        $project->description = $request->description;
        $project->category = $request->category;
        $project->save();

        return redirect()->route('dashboard')
            ->with('success', 'Project berhasil diperbarui!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal memperbarui project: ' . $e->getMessage());
    }
}

    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);

            if ($project->user_id !== Auth::id()) {
                return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk menghapus project ini.');
            }

            if (Storage::disk('public')->exists($project->file_path)) {
                Storage::disk('public')->delete($project->file_path);
            }

            $project->delete();

            return redirect()->route('dashboard')->with('success', 'Project berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus project: ' . $e->getMessage());
        }
    }
}
