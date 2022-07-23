<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@if(!empty($task))タスク編集@elseタスク追加@endif</h4>
                @if(!empty(session('message')))
                    <div class="alert alert-danger" role="alert">
                        {{session('message')}}
                    </div>
                @endif
                <form class="forms-sample" action="{{$action}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ユーザー名</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" disabled value="{{$user_name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">タイトル<span class="text-danger">※</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="タイトル" value="@if(!empty($task)){{$task->title}}@endif">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contents" class="col-sm-3 col-form-label">内容</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="contents" name="contents" placeholder="内容" rows="4" cols="40">@if(!empty($task)){{$task->contents}}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deadline" class="col-sm-3 col-form-label">期限<span class="text-danger">※</span></label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="@if(!empty($task)){{$task->deadline}}@endif">
                        </div>
                    </div>

                    @if(!empty($task))
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">ステータス</label>
                            <div class="col-sm-9">
                                <select class="form-select" aria-label="Default select example" name="completion_flag">
                                    <option value="0" @if($task->completion_flag === 0) selected @endif>作業中</option>
                                    <option value="1" @if($task->completion_flag === 1) selected @endif>作業完了</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="task_id" value="{{$task->id}}">
                    @endif

                    <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">@if(!empty($task))更新@else追加@endif</button>
                        @if(!empty($task))
                            <a class="btn btn-light" href="{{route('delete',['task_id' => $task->id])}}" onclick="window.confirm('これが確認ダイアログです。')">削除</a>
                        @endif
                        <a class="btn btn-light" href="{{route('index')}}">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
