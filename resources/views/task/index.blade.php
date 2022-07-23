@include('layouts.app')
<div class="d-flex align-items-center">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">タスク一覧</h4>
                @if(!empty(session('message')))
                    <div class="alert alert-danger" role="alert">
                        {{session('message')}}
                    </div>
                @endif
                <div class="text-end">
                <a href="{{route('add')}}" class="btn btn-primary me-2">＋タスクの追加</a>
                </div>
                <div class="table-responsive">
                    @if(!$task_list->isEmpty())
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>期限</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($task_list as $task)
                            <tr @if($task->completion_flag == 1) class="bg-light bg-gradient" @endif>
                                <td>{{$task->title}}</td>
                                <td>{{$task->deadline}}</td>
                                <td>
                                    <div class="text-right">
                                        <a href="{{route('edit',$task->id)}}" class="btn btn-primary">編集</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        タスクが存在しません。
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
