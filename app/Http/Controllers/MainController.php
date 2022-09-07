<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class MainController extends Controller
{
    public function index(){
        $tasks = Task::with('user')->get();
        return view('dashboard', compact('tasks'));
    }
}
