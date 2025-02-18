<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Afficher la liste des tâches
    public function index()
    {
        $tasks = Task::paginate(10); // Remplace '10' par le nombre de tâches par page
        return view('tasks.index', compact('tasks'));
    }
    
    

    // Afficher le formulaire d'ajout de tâche
    public function create()
    {
        return view('tasks.create');
    }

    // Enregistrer une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée avec succès!');
    }

    // Afficher le formulaire de modification d'une tâche
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Mettre à jour une tâche
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
    
        return response()->json(['success' => true]);
    }

    // Supprimer une tâche
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès!');
    }
}
