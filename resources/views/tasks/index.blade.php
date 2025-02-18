@extends('layouts.app')

@section('title', 'Mes Tâches')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 d-none d-md-block p-4 bg-light shadow-sm rounded-lg" style="height: 100vh;">
            <h3 class="text-center mb-4 font-weight-bold"> ☰ Menu</h3>
            <div class="list-group">
                <a href="{{ route('tasks.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Tâches
                    <span class="badge bg-primary rounded-pill">{{ count($tasks) }}</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">Calendrier</a>
            </div>
            <div class="mt-5">
                <a href="#" class="btn btn-outline-secondary w-100 mb-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-cog me-2"></i> ⚙️ Paramètres
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt me-2"></i> 🔒 Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4">
            <div class="d-flex justify-content-between mb-4">
                <div></div>
                <input type="text" class="form-control w-100 w-md-25" placeholder="🔍 Rechercher">
            </div>

            <!-- Task Cards -->
            <div class="row">
                @foreach($tasks as $task)
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card shadow-lg hover-effect" style="background-color: {{ $task->color ?? '#f8f9fa' }}; border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $task->title }}</h5>
                                <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($task->description, 80) }}</p>
                                <p class="card-text text-muted">📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p>
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-sm btn-outline-info edit-task-btn" data-id="{{ $task->id }}">✏️ Modifier</button>
                                    <button class="btn btn-sm btn-outline-danger delete-task" data-id="{{ $task->id }}">🗑️</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Add Task Card -->
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card shadow d-flex align-items-center justify-content-center hover-effect" style="background-color: #e0e0e0; border-radius: 15px; height: 200px;">
                        <a href="#" class="text-dark text-decoration-none display-4 font-weight-bold" id="add-task-btn">+</a>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Modifier -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la Tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-task-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-task-id">
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" id="edit-task-title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="edit-task-description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date d'échéance</label>
                        <input type="date" class="form-control" id="edit-task-date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="add-task-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" id="add-task-title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="add-task-description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date d'échéance</label>
                        <input type="date" class="form-control" id="add-task-date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Ouvrir le modal d'ajout
    document.getElementById('add-task-btn').addEventListener('click', function() {
        new bootstrap.Modal(document.getElementById('addTaskModal')).show();
    });

    // Soumettre le formulaire d'ajout
    document.getElementById('add-task-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = {
            title: document.getElementById('add-task-title').value,
            description: document.getElementById('add-task-description').value,
            due_date: document.getElementById('add-task-date').value,
            _token: document.querySelector('input[name="_token"]').value
        };

        fetch(`/tasks`, {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        }).then(response => response.json())
          .then(() => {
              Swal.fire({
                  title: "Tâche ajoutée !",
                  text: "Votre tâche a été enregistrée avec succès.",
                  icon: "success",
                  confirmButtonText: "OK"
              }).then(() => location.reload());
          });
    });

    // Modifier une tâche
    document.querySelectorAll('.edit-task-btn').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-id');
            
            fetch(`/tasks/${taskId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-task-id').value = data.id;
                    document.getElementById('edit-task-title').value = data.title;
                    document.getElementById('edit-task-description').value = data.description;
                    document.getElementById('edit-task-date').value = data.due_date;

                    new bootstrap.Modal(document.getElementById('editTaskModal')).show();
                });
        });
    });

    // Soumettre la modification avec SweetAlert
    document.getElementById('edit-task-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const taskId = document.getElementById('edit-task-id').value;
        const formData = {
            title: document.getElementById('edit-task-title').value,
            description: document.getElementById('edit-task-description').value,
            due_date: document.getElementById('edit-task-date').value,
            _method: 'PUT',
            _token: document.querySelector('input[name="_token"]').value
        };

        fetch(`/tasks/${taskId}`, {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        }).then(() => {
            Swal.fire({
                title: "Tâche modifiée !",
                text: "La tâche a été mise à jour avec succès.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => location.reload());
        });
    });

    // Suppression avec SweetAlert
    document.querySelectorAll('.delete-task').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-id');

            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Cette action est irréversible !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, supprimer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/tasks/${taskId}`, {
                        method: "POST",
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ _method: "DELETE", _token: "{{ csrf_token() }}" })
                    }).then(() => {
                        Swal.fire("Supprimé !", "La tâche a été supprimée.", "success").then(() => location.reload());
                    });
                }
            });
        });
    });
});
</script>

@endsection
