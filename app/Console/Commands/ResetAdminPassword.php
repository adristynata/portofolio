<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:password {password? : Kata sandi baru untuk admin} {--email= : Alamat email admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ubah atau reset kata sandi (password) akun admin portofolio';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');

        if ($email) {
            $user = User::where('email', $email)->first();
        } else {
            $user = User::where('is_admin', true)->first() ?? User::first();
        }

        if (!$user) {
            $this->error('Akun pengguna/admin tidak ditemukan di database.');
            return 1;
        }

        $password = $this->argument('password');

        if (!$password) {
            $password = $this->secret('Masukkan kata sandi baru untuk akun [' . $user->email . ']:');
        }

        if (empty($password) || strlen($password) < 8) {
            $this->error('Kata sandi harus minimal 8 karakter.');
            return 1;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info('✓ Berhasil! Kata sandi akun [' . $user->email . '] telah berhasil diperbarui.');
        $this->line('Anda sekarang dapat login menggunakan kata sandi baru di: ' . url('/login'));

        return 0;
    }
}
