<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

// Route de la page d'accueil (home) pour les utilisateurs non authentifiés
Route::get('/', function () {
    return Auth::check() ? redirect('/tasks') : view('auth.login');
});

// Routes d'authentification
Auth::routes();

// Route pour la page d'accueil après connexion
Route::get('/tasks', [App\Http\Controllers\HomeController::class, 'index'])->name('tasks');

// Routes protégées par l'authentification
Route::middleware(['auth'])->group(function () {
    // Liste des tâches
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Ajouter une tâche
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // Modifier une tâche
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    
    
    // Supprimer une tâche
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
