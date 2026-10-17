<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('dashboard.certificate.index', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'certificates');
        }

        Certificate::create($data);

        return back()->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($certificate->image && !str_starts_with($certificate->image, 'data:')) {
                try {
                    Storage::disk('public')->delete($certificate->image);
                } catch (\Throwable $e) {}
            }
            $data['image'] = $this->storeImage($request->file('image'), 'certificates');
        }

        $certificate->update($data);

        return back()->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image && !str_starts_with($certificate->image, 'data:')) {
            try {
                Storage::disk('public')->delete($certificate->image);
            } catch (\Throwable $e) {}
        }
        $certificate->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus!');
    }
}
