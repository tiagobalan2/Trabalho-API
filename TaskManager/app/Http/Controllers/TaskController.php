<?php

namespace App\Http\Controllers;

Use App\Models\Task;
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
        $tasks = Task::all();

        return response()->json($tasks);
     }

    /**
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'boolean'
        ]);
    
        $task = new Task;
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->save();
    
        return response()->json($task);
        
    }

    /**
     * Update the specified resource in storage
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, Task $task)
     {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'boolean'
        ]);
        $task->update($validatedData);

        return response()->json($task);
     }

     /**
     * Remove the specified resource from storage.
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }
}