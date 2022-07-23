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

    //タスク一覧
    public function scopeTaskIndex($query, $request)
    {

        $where_list = self::CreateWhereList($request);
        //「期限超過のみ」にチェックされていた場合
        if(!empty($request->deadline)){
            return self::where($where_list)->whereDate('deadline','<', now())->orderBy('created_at', 'desc')->paginate(5);
        }

        return self::where($where_list)->orderBy('created_at', 'desc')->paginate(5);
    }

    //DB検索条件作成
    public function CreateWhereList($request)
    {
        $where_list = [['user_id',Auth::id()]];

        //タスク名が検索されていた場合
        if(!empty($request->search_title)){
            $where_list[] = ['title', 'like', '%'.$request->search_title.'%'];
        }

        //「期限超過のみ」にチェックされていた場合
        if(!empty($request->deadline)){
            $where_list[] = ['deadline', '!=', null];
        }

        //「完了済みを表示」にチェックされていた場合
        if(empty($request->completion_flag)){
            $where_list[] = ['completion_flag', 0];
        }

        return $where_list;
    }

    //タスク作成
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


    //タスク情報アップデート
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

    //タスク削除
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
