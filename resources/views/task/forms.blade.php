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
                    <div class="form-group row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ユーザー名</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" disabled value="{{$user_name}}">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="title" class="col-sm-3 col-form-label">タイトル<span class="text-danger">※</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="タイトル" value="@if(old('title')){{old('title')}}@elseif(!empty($task)){{$task->title}}@endif">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="contents" class="col-sm-3 col-form-label">内容</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('contents') is-invalid @enderror" id="contents" name="contents" placeholder="内容" rows="4" cols="40">@if(old('contents')){{old('contents')}}@elseif(!empty($task)){{$task->contents}}@endif</textarea>
                            @error('contents')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="deadline" class="col-sm-3 col-form-label">期限</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="@if(old('deadline')){{old('deadline')}}@elseif(!empty($task)){{$task->deadline}}@endif">
                            @error('deadline')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    @if(!empty($task))
                        <div class="form-group row mb-3">
                            <label for="status" class="col-sm-3 col-form-label">ステータス</label>
                            <div class="col-sm-9">
                                <select class="form-select @error('completion_flag') is-invalid @enderror" name="completion_flag">
                                    <option value="0"
                                            @if(old('completion_flag') && old('completion_flag') === "0")
                                                selected
                                            @elseif($task->completion_flag === 0)
                                                selected
                                            @endif>未対応</option>
                                    <option value="1"
                                            @if(!empty(old('completion_flag')) && old('completion_flag') === "1")
                                                selected
                                            @elseif($task->completion_flag === 1)
                                                selected
                                           @endif>完了</option>
                                </select>
                                @error('completion_flag')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="task_id" value="{{$task->id}}">
                    @endif

                    <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">@if(!empty($task))更新@else追加@endif</button>
                        @if(!empty($task))
                            <a class="btn btn-danger me-2" href="{{route('delete',['task_id' => $task->id])}}" onclick="window.confirm('これが確認ダイアログです。')">削除</a>
                        @endif
                        <a class="btn btn-light" href="{{route('index')}}">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
