@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">タスク追加</h4>
                        @if(!empty(session('message')))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        @include('task.forms')
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary me-2" onclick="onSubmit()">@if(!empty($task))更新@else追加@endif</button>
                            <a class="btn btn-light" href="{{route('index')}}">キャンセル</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset("js/task/forms.js")}}"></script>
