<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Update main user / admin profile fields
        $user = User::first();
        if ($user) {
            $user->update([
                'name' => 'Adristy Akiko Yukinata',
                'role_title' => 'Web Developer',
                'bio' => 'Saya adalah junior web developer SMK Negeri 1 Bangsri yang berfokus pada pengembangan web dan desain antarmuka (UI/UX).',
                'education' => 'Teknik Informatika / RPL',
                'focus' => 'Web & Backend Dev',
                'phone' => '+62 89639685566',
                'location' => 'Jepara',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'instagram_url' => 'https://instagram.com',
                'whatsapp_url' => 'https://wa.me/6289639685566',
            ]);
        }

        // Seed Skills if empty
        if (Skill::count() === 0) {
            Skill::create(['name' => 'Laravel', 'level' => 'Beginner', 'percentage' => 70, 'category' => 'Backend Development']);
            Skill::create(['name' => 'HTML & CSS', 'level' => 'Intermediate', 'percentage' => 85, 'category' => 'Frontend Development']);
            Skill::create(['name' => 'Tailwind CSS', 'level' => 'Intermediate', 'percentage' => 80, 'category' => 'Frontend Development']);
            Skill::create(['name' => 'JavaScript', 'level' => 'Beginner', 'percentage' => 65, 'category' => 'Frontend Development']);
            Skill::create(['name' => 'PHP', 'level' => 'Beginner', 'percentage' => 70, 'category' => 'Backend Development']);
            Skill::create(['name' => 'MySQL', 'level' => 'Beginner', 'percentage' => 75, 'category' => 'Database']);
            Skill::create(['name' => 'Figma', 'level' => 'Intermediate', 'percentage' => 85, 'category' => 'UI/UX Design']);
            Skill::create(['name' => 'MongoDB', 'level' => 'Beginner', 'percentage' => 70, 'category' => 'Database']);
            Skill::create(['name' => 'Postman', 'level' => 'Intermediate', 'percentage' => 80, 'category' => 'API Testing & Tools']);
            Skill::create(['name' => 'Adobe Illustrator', 'level' => 'Intermediate', 'percentage' => 75, 'category' => 'Graphic & Vector Design']);
        }

        // Seed Experiences if empty
        if (Experience::count() === 0) {
            Experience::create([
                'type' => 'PENDIDIKAN',
                'title' => 'Web Developer',
                'organization' => 'Organisasi',
                'period' => '2024 – 2026',
                'description' => 'masih berlangsung sampai sekarang'
            ]);
            Experience::create([
                'type' => 'PENDIDIKAN',
                'title' => 'SMK Negeri 1 Bangsri',
                'organization' => 'Teknik Komputer & Informatika / RPL',
                'period' => '2023 – Sekarang',
                'description' => 'Fokus pada Pengembangan Perangkat Lunak, Pemrograman Web (Laravel, PHP, Tailwind CSS), dan Desain UI/UX.'
            ]);
        }

        // Seed Certificates if empty
        if (Certificate::count() === 0) {
            Certificate::create([
                'type' => 'SERTIFIKASI KOMPETENSI',
                'title' => 'Junior Web Developer',
                'issuer' => 'SMK Negeri 1 Bangsri & Partners',
                'year' => '2024',
            ]);
            Certificate::create([
                'type' => 'SERTIFIKASI UI/UX',
                'title' => 'UI/UX Design Fundamentals',
                'issuer' => 'Online Learning Certificate',
                'year' => '2024',
            ]);
        }
    }
}
