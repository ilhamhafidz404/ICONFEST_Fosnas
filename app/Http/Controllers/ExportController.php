<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{ UsersExport, TasksExport, SchoolExport };

class ExportController extends Controller
{
    public function user()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function task(){
        return Excel::download(new TasksExport, 'tasks.xlsx');
    }
    public function school(){
        return Excel::download(new SchoolExport, 'schools.xlsx');
    }
}
