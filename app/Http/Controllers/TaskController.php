<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $task_list = Task::where('user_id',Auth::id())->get();
        return view('task.index',compact('task_list'));
    }

    public function add()
    {
        $action = route('create');
        $user_name = Auth::User()->name;
        return view('task.add',compact('action','user_name'));
    }

    public function create(TaskCreateRequest $request)
    {
        $model_response = Task::TaskCreate($request);
        if($model_response['commit_bool']){
            return redirect('/task/edit/'.$model_response['task_id'])->with('message','タスクを作成しました。');
        }
        return redirect('/task/add')->with('message','タスクの作成に失敗しました。');
    }

    public function edit($task_id)
    {
        $exists = Task::where([['id', $task_id],['user_id', Auth::id()]])->exists();
        if (!$exists) {
            return App::Abort(404);
        }
        $action = route('update');
        $user_name = Auth::User()->name;
        $task = Task::find($task_id);
        return view('task.edit',compact('action','user_name','task'));
    }

    public function update(TaskUpdateRequest $request)
    {
        $model_response = Task::TaskUpdate($request);
        if(!$model_response['exists']){
            App::Abort(404);
        }
        if($model_response['commit_bool']){
            return redirect('/task/edit/'.$model_response['task_id'])->with('message','タスクを更新しました。');
        }
        return redirect('/task/edit'.$model_response['task_id'])->with('message','タスクの更新に失敗しました。');
    }

    public function delete($task_id)
    {
        $model_response = Task::TaskDelete($task_id);
        if(!$model_response['exists']){
            App::Abort(404);
        }
        return redirect('/task')->with('message','タスクを削除しました。');
    }

}
