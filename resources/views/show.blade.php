@extends('layout')

@section('content')
    <h1>社員詳細</h1>
    <table class='table'>
        <tbody>
                <tr>
                    <td class="text-center">社員コード</td>
                    <td class="text-center">{{ $staff_paramertar->staff_code }}</td>
                </tr>
                <tr>
                    <td class="text-center">姓名</td>
                    <td class="text-center">{{ $staff_paramertar->last_name }} {{ $staff_paramertar->first_name }}</td>
                </tr>
                <tr>
                    <td class="text-center">姓名(ローマ字)</td>
                    <td class="text-center">{{ $staff_paramertar->last_name_romaji }} {{ $staff_paramertar->first_name_romaji }}</td>
                </tr>
                <tr>
                    <td class="text-center">メールアドレス</td>
                    <td class="text-center">{{ $staff_paramertar->mail_address }}</td>
                </tr>
                <tr>
                    <td class="text-center">所属</td>
                    <td class="text-center">{{ $staff_paramertar->job_name }}</td>
                </tr>
                <tr>
                    <td class="text-center">新卒中途</td>
                    <td class="text-center">{{ $staff_paramertar->new_glad }}</td>
                </tr>
                <tr>
                    <td class="text-center">入社年月日</td>
                    <td class="text-center">{{ $staff_paramertar->joined_year }}</td>
                </tr>
                <tr>
                    <td class="text-center">案件</td>
                    <td class="text-center">{!! nl2br($staff_paramertar->project_type) !!}</td>
                </tr>
        </tbody>
    </table>
    <div class="text-center">
        <div class="btn-group">
            <a href="{{ route('staff.edit', ['id' => $staff_paramertar->id]) }}" class="btn btn-primary mr-3" role="button">変更</a>
            {{ Form::open(['method' => 'delete', 'route' => ['staff.destroy', $staff_paramertar->id]]) }}
                {{ Form::submit('削除',['class'=> 'btn btn-primary mr-3']) }}
            {{ Form::close() }}
            <a class="btn btn-primary" href="{{ route('staff.list') }}" role="button">一覧へ</a>
        </div>
    </div>


@endsection