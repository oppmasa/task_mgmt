@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">登録が完了しました。</div>

                    <div class="card-body">
                        登録が完了しました。<br>
                        下記のボタンをクリックして、ログイン画面からログインしてください。<br>
                        <br>
                        <a class="btn btn-secondary" href="{{route('login')}}">ログイン画面へ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
