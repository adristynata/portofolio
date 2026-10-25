<?php

namespace App\Http\Controllers;

use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        // Ensure photo column supports base64 data URIs
        $this->ensureColumnSupportsBase64('users', 'photo');

        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role_title' => 'nullable|string|max:255',
            'hero_bio' => 'nullable|string',
            'bio' => 'nullable|string',
            'education' => 'nullable|string|max:255',
            'focus' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar oleh pengguna lain.',
            'photo.image' => 'File foto profil harus berupa file gambar valid.',
            'photo.mimes' => 'Format foto harus berupa JPG, PNG, GIF, SVG, atau WEBP.',
            'photo.max' => 'Ukuran foto maksimal adalah 10MB.',
        ]);

        $data = $request->only([
            'name', 'email', 'role_title', 'hero_bio', 'bio', 'education', 
            'focus', 'phone', 'location', 'github_url', 
            'linkedin_url', 'instagram_url', 'whatsapp_url'
        ]);

        if ($request->hasFile('photo')) {
            try {
                $storedPhoto = $this->storeImage($request->file('photo'), 'profile', 800, 80);
                $data['photo'] = $storedPhoto;
                if (str_starts_with($storedPhoto, 'data:')) {
                    $this->ensureColumnSupportsBase64('users', 'photo');
                }
            } catch (\Throwable $e) {
                Log::warning('Failed uploading profile photo: ' . $e->getMessage());
            }
        }

        try {
            $data['is_admin'] = true;
            $user->fill($data);
            $user->save();
            return back()->with('success', 'Profil dan foto berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Auto-heal column if Data Too Long occurred (code 1406 / SQLSTATE 22001)
            if (isset($data['photo']) && str_starts_with($data['photo'], 'data:')) {
                try {
                    $this->ensureColumnSupportsBase64('users', 'photo');
                    $user->save();
                    return back()->with('success', 'Profil dan foto berhasil diperbarui!');
                } catch (\Throwable $retryErr) {
                    Log::error('Profile retry error: ' . $retryErr->getMessage());
                }
            }
            Log::error('Profile DB query error: ' . $e->getMessage());
            return back()
                ->withInput($request->except(['photo']))
                ->with('error', 'Gagal menyimpan profil: Kapasitas kolom database sedang disesuaikan. Silakan klik simpan kembali.');
        } catch (\Throwable $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()
                ->withInput($request->except(['photo']))
                ->with('error', 'Gagal menyimpan profil. Silakan periksa kembali formulir Anda.');
        }
    }
}
