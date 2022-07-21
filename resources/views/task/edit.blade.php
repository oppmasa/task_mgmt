@include('layouts.app')
@if(!empty(session('message')))
    <div class="alert alert-danger" role="alert">
        {{session('message')}}
    </div>
@endif
@include('task.forms')
