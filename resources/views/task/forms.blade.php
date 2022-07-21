<div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">タスク追加</h4>
            <form class="forms-sample" action="{{$action}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ユーザー名</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" disabled value="{{$user_name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">タイトル</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="タイトル" value="@if(!empty($task)){{$task->title}}@endif">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">内容</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="contents" name="contents" placeholder="内容" rows="4" cols="40">@if(!empty($task)){{$task->contents}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">期限</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="@if(!empty($task)){{$task->deadline}}@endif">
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">追加</button>
                    <a class="btn btn-light" href="{{route('index')}}">キャンセル</a>
                </div>
            </form>
        </div>
    </div>
</div>
