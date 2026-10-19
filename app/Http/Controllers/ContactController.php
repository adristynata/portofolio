<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => [
                'required',
                'string',
                'email:rfc',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
                'max:255',
            ],
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:5|max:5000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama minimal terdiri dari 2 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Format email wajib menggunakan akun @gmail.com (contoh: nama@gmail.com).',
            'message.required' => 'Pesan Anda wajib diisi.',
            'message.min' => 'Pesan minimal terdiri dari 5 karakter.',
        ]);

        Message::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'subject' => !empty($validated['subject']) ? trim($validated['subject']) : null,
            'message' => trim($validated['message']),
        ]);

        return back()->with('contact_success', 'Terima kasih! Pesan Anda telah terkirim dan akan segera ditanggapi.');
    }
}
