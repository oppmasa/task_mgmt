<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }

    public function add()
    {
        $action = route('create');
        $user_name = Auth::User()->name;
        return view('task.add',compact('action','user_name'));
    }

    public function create(Request $request)
    {
        $model_response = Task::TaskCreate($request);
        if($model_response['commit_bool']){
            return redirect('/task/edit/'.$model_response['task_id'])->with('message','タスクを作成しました。');
        }
        return redirect('/task/add')->with('message','タスクを作成に失敗しました。');
    }

    public function edit($task_id)
    {
        $action = route('update');
        $user_name = Auth::User()->name;
        $task = Task::find($task_id);
        return view('task.edit',compact('action','user_name','task'));
    }

}
