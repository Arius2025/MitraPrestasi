<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LombaController extends Controller
{
    public function index()
{
    $blogs = Blog::whereNotNull('published_at')->orderByDesc('published_at')->take(3)->get();
    $lombas = Lomba::latest()->paginate(10);

    return view('admin.lomba.index', compact('blogs', 'lombas'));
}

    public function create()
    {
        return view('admin.lomba.create', [
            'submit' => 'Simpan',
            'action' => route('admin.lomba.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'categories' => 'required|array',
        'categories.*' => 'in:sd,smp,sma',
        'registration_date' => 'required|date',
        'link' => 'nullable|url|max:255',
        'competition_date' => 'required|date|after_or_equal:registration_date',
        'thumbnail' => 'nullable|image|max:2048',
        'files.*' => 'nullable|file|max:5120',
    ]);

    $data['categories'] = json_encode($data['categories']);

    if ($request->hasFile('thumbnail')) {
    $image = $request->file('thumbnail');
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    // Simpan ke folder storage/thumbnail di root Laravel
    $image->move(base_path('storage/thumbnail'), $imageName);

    $data['thumbnail'] = $imageName;
}
    

    $lomba = Lomba::create($data);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('lomba_files', 'public');
            $lomba->files()->create(['filename' => $path]);
        }
    }

    return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil ditambahkan.');
}


    public function edit(Lomba $lomba)
    {
        return view('admin.lomba.edit', [
            'lomba' => $lomba,
            'submit' => 'Update',
            'action' => route('admin.lomba.update', $lomba->id),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Lomba $lomba)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'categories' => 'required|array',
        'categories.*' => 'in:sd,smp,sma',
        'registration_date' => 'required|date',
        'link' => 'nullable|url|max:255',
        'competition_date' => 'required|date|after_or_equal:registration_date',
        'thumbnail' => 'nullable|image|max:2048',
        'files.*' => 'nullable|file|max:5120',
    ]);

    $data['categories'] = json_encode($data['categories']);

    if ($request->hasFile('thumbnail')) {
    if ($lomba->thumbnail) {
        // Hapus file lama dari folder root
        $oldPath = base_path('storage/thumbnail/' . $lomba->thumbnail);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    $image = $request->file('thumbnail');
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    // Simpan ke folder root Laravel
    $image->move(base_path('storage/thumbnail'), $imageName);

    $data['thumbnail'] = $imageName;
}


    $lomba->update($data);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('lomba_files', 'public');
            $lomba->files()->create(['filename' => $path]);
        }
    }

    return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil diperbarui.');
}


public function destroy(Lomba $lomba)
{
    // Hapus file terkait jika ada
    foreach ($lomba->files as $file) {
        Storage::disk('public')->delete($file->filename);
        $file->delete();
    }

    // Hapus thumbnail jika ada
    if ($lomba->thumbnail) {
        Storage::disk('public')->delete($lomba->thumbnail);
    }

    $lomba->delete();

    return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil dihapus.');
}

}
