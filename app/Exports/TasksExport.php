<?php

use Maatwebsite\Excel\Concerns\FromCollection;

class TasksExport implements FromCollection
{
    public function collection()
    {
        return Task::where('user_id', auth()->id())->get();
    }
}
