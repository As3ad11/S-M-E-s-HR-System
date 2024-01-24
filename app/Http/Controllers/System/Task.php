<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\PersonalProfile;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\Request;

class Task extends Controller
{
    public function Index(Request $request)
    {
        if ($request->has('assign_task')) {
            UserTask::create([
                'user_id' => $request->get('user_id'),
                'task' => $request->get('task'),
                'created_at' => date('Y-m-d'),
                'due_date' => $request->get('due_date'),
                'status' => 'NEW',
            ]);
        }

        if ($request->has('submit_edit_task')) {
            UserTask::where('id', $request->get('task_id'))->update([
                'task' => $request->get('task'),
                'created_at' => $request->get('created_at'),
                'due_date' => $request->get('due_date'),
            ]);
        }

        if ($request->has('submit_task_progress')) {
            UserTask::where('id', $request->get('task_id'))->update([
                'status' => 'ON PROGRESS',
            ]);
        }

        if ($request->has('submit_task_completed')) {
            UserTask::where('id', $request->get('task_id'))->update([
                'status' => 'COMPLETED',
            ]);
        }

        if (auth()->user()->isAdmin()) {
            $tasks = UserTask::orderByDesc('created_at')->get();
        } else if (auth()->user()->isManager()) {
            $tasks = UserTask::where('assigned_id', auth()->user()->id)->orWhere('user_id', auth()->user()->id)->orderByDesc('created_at')->get();
        } else {
            $tasks = UserTask::where('user_id', auth()->user()->id)->orderByDesc('created_at')->get();
        }

        return view('system.task.index', [
            'tasks' => $tasks,
            'users' => User::all(),
        ]);
    }
}
