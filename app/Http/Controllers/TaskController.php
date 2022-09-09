<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPermission = auth()->user()->permission_name;
        $tasks = Task::with('user')->get();
        return view('tasks.tasks', compact('tasks','currentPermission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {

        $this->authorize('create', Task::class);

        // Post olan veriye user_id ekleme
        $data = [
            'title' => $request->get('title'),
            'desc' => $request->get('desc'),
            'user_id' => auth()->user()->id,
        ];

        // Task inserti
        Task::create($data);
        return redirect()->route('tasks.index')->withSuccess('Tasks Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request,Task $task)
    {

        $this->authorize('update', $task);

        $task->update([
            'title' => $request->get('title'),
            'desc' => $request->get('desc'),
        ]);
        return redirect()->route('tasks.index')->withSuccess('Tasks updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete',$task);

        $task->delete() ?? abort(404,'Task Bulunamadı');

        return redirect()->route('tasks.index');
    }
}
