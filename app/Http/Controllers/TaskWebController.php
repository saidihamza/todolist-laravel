<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TasksExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Task;

class TaskWebController extends Controller
{
    

    public function index()
    {
        $tasks = Task::where('id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function exportExcel()
    {
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }
    
    public function exportPDF()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        $pdf = Pdf::loadView('tasks.pdf', compact('tasks'));
        return $pdf->download('tasks.pdf');
    }
}
