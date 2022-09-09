<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class MainController extends Controller
{
    public function index(){

        if(auth()->user()->permission_name == 'Admin'){
            $tasks = Task::with('user')->get();
        }
        else{
            $tasks = Task::where('user_id', auth()->user()->id)->with('user')->get();
        }
        return view('dashboard', compact('tasks'));
    }
}
