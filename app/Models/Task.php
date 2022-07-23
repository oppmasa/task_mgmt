<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    public function scopeTaskCreate($query, $request)
    {
        $user_id = Auth::id();
        DB::beginTransaction();
        try {
            $task_id = self::insertGetId([
                'user_id' => $user_id,
                'title' => $request->title,
                'contents' => $request->contents,
                'deadline' => $request->deadline,
            ]);
            DB::commit();
            return ["commit_bool" => true, 'task_id' => $task_id];
        } catch
            (Exception $e) {
            DB::rollback();
            return ["commit_bool" => false];
        }
    }

    public function scopeTaskUpdate($query, $request)
    {
        $task_id = $request->task_id;

        $exists = self::where([['id', $task_id],['user_id', Auth::id()]])->exists();
        if (!$exists) {
            return ['exists' => false];
        }

        DB::beginTransaction();
        try {
            self::where('id',$task_id)
                ->update([
                'title' => $request->title,
                'contents' => $request->contents,
                'completion_flag' =>  $request->completion_flag,
                'deadline' => $request->deadline,
            ]);
            DB::commit();
            return ["commit_bool" => true, 'exists' => true, 'task_id' => $task_id];
        } catch
        (Exception $e) {
            DB::rollback();
            return ["commit_bool" => false, 'exists' => true, 'task_id' => $task_id];
        }
    }

    public function scopeTaskDelete($query, $task_id)
    {
        $exists = self::where([['id', $task_id],['user_id', Auth::id()]])->exists();
        if (!$exists) {
            return ['exists' => false];
        }
        self::destroy($task_id);

        return ['exists' => true];
    }
}
