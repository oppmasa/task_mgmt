@include('layouts.app')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">タスク一覧</h4>
                @if(!empty(session('message')))
                    <div class="alert alert-danger" role="alert">
                        {{session('message')}}
                    </div>
                @endif
                <form action="{{route('index')}}" method="get">
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_title" placeholder="タスクを入力" value="@if(!empty($search_title)){{$search_title}}@endif">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
                        </div>
                    </div>
                </form>

                <div class="text-end">
                    <a href="{{route('add')}}" class="btn btn-primary m-2">＋タスクの追加</a>
                </div>
                <div class="table-responsive">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="deadline" onclick="checkdeadline()" @if(!empty($check_list['deadline'])) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox1">期限超過のみ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="completion_flag" onclick="checkcompletion()" @if(!empty($check_list['completion_flag'])) checked @endif>
                        <label class="form-check-label" for="inlineCheckbox2">完了済みを表示</label>
                    </div>
                    @if(!$task_list->isEmpty())
                    <table class="table table-hover" id="task_list">
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
                                <td>@if(empty($task->deadline))-@else{{$task->deadline}}@endif</td>
                                <td>
                                    <div class="text-end me-5">
                                        <a href="{{route('edit',$task->id)}}" class="btn btn-secondary">編集</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <div class="pagination justify-content-center">
                            {{ $task_list->onEachSide(5)->appends(request()->query())->links() }}
                        </div>
                    @else
                        <p class="mt-3">タスクが存在しません。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    function checkdeadline(){
        if ((document.getElementById("deadline")).checked) {
            location.href = '{{route('index',['deadline' => 'on'])}}';
        }else{
            location.href = '{{route('index')}}';
        }
    }

    function checkcompletion(){
        if ((document.getElementById("completion_flag")).checked) {
            location.href = '{{route('index',['completion_flag' => 'on'])}}';
        }else{
            location.href = '{{route('index')}}';
        }
    }
</script>
