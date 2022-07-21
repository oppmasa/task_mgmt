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
}
