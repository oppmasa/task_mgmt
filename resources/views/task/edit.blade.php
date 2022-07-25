@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">タスク編集</h4>
                        @if(!empty(session('message')))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        @include('task.forms')
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
                        <form action="{{route("delete",["task_id" => $task->id])}}" method="post" id="delete_form">@csrf</form>
                        @endif
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary me-2" onclick="onSubmit()">@if(!empty($task))更新@else追加@endif</button>
                            <button type="button" class="btn btn-danger me-2" onclick="onDeleteConfirm()">削除</button>
                            <a class="btn btn-light" href="{{route('index')}}">キャンセル</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset("js/task/forms.js")}}"></script>
