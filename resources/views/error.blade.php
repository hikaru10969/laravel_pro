@extends('layout')

@section('content')
    <h1>エラー</h1>
    <div class="alert alert-danger">
        <li>{{ $error_msg }}</li>
    </div>
    <div class="text-center">
        <div class="btn-group">
            <a href="{{ route('staff.list') }}" class="btn btn-primary ml-3" role="button">社員一覧へ戻る</a>
        </div>
    </div>

@endsection