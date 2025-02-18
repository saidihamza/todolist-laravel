@extends('layouts.app')

@section('title', 'Modifier la Tâche')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 p-3 bg-light" style="height: 100vh;">
            <h3 class="text-center mb-4">Menu</h3>
            <div class="list-group">
                <a href="{{ route('tasks.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Tâches
                    <span class="badge badge-primary">{{ count($tasks ?? []) }}</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">Calendrier</a>
            </div>
            <div class="mt-5">
                <a href="#" class="d-block mb-2">⚙️ Paramètres</a>
                <a href="#" class="d-block">🔒 Déconnexion</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4">
            <h2 class="mb-4">Modifier la Tâche</h2>

            <!-- Edit Task Form Card -->
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Date d'échéance</label>
                            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="completed" class="form-check-input" {{ $task->completed ? 'checked' : '' }}>
                            <label class="form-check-label">Marquer comme terminé</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
