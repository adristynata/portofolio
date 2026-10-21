<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    $profile = (auth()->check() && auth()->user()->is_admin ? auth()->user() : null)
            ?? User::where('is_admin', true)->orderByDesc('updated_at')->first()
            ?? User::orderByDesc('updated_at')->first();
    $projects = Project::latest()->get();
    $skills = Skill::all();
    $experiences = Experience::latest()->get();
    $certificates = Certificate::latest()->get();

    return view('welcome', compact('profile', 'projects', 'skills', 'experiences', 'certificates'));
})->name('home');

// CSRF Keep-Alive / Token Refresh
Route::get('/refresh-csrf', function () {
    return response()->json([
        'token' => csrf_token(),
        'status' => 'ok'
    ]);
})->middleware('web')->name('csrf.refresh');

// Public Contact Form Handler
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Profile Account (Default Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin CMS Panel
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Profile & Social Links Management
    Route::get('/profile-cms', [AdminProfileController::class, 'index'])->name('admin.profile.index');
    Route::post('/profile-cms', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // CMS Resources
    Route::resource('project', ProjectController::class)->names('project');
    Route::resource('skill', SkillController::class)->names('skill');
    Route::resource('experience', ExperienceController::class)->names('experience');
    Route::resource('certificate', CertificateController::class)->names('certificate');
    Route::resource('message', MessageController::class)->only(['index', 'destroy'])->names('message');
    Route::post('/message/{message}/read', [MessageController::class, 'markAsRead'])->name('message.read');
});

require __DIR__.'/auth.php';
