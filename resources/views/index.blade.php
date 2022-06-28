@extends('layouts.layout')

@section('content')
    <h1 >社員一覧</h1>
    <table class='table table-striped table-hover'>
        <thead>
            <tr>
                <th class="text-center align-middle">社員コード</th>
                <th class="text-center align-middle">姓名</th>
                <th class="text-center align-middle">所属</th>
                <th class="text-center align-middle">新卒中途</th>
                <th class="text-center align-middle">入社年月日</th>
                <th class="text-center align-middle"></th>
            </tr>
        </thead>
        <tbody>
            @if (count($staffs) > 0)
                @foreach ($staffs as $staff)
                    <tr>
                        <td class="text-center align-middle" style="width: 10%">{{ $staff->staff_code }}</td>
                        <td class="text-center align-middle" style="width: 20%">{{ $staff->last_name }} {{ $staff->first_name }}</td>
                        <td class="text-center align-middle" style="width: 20%">{{ $staff->job_name }}</td>
                        <td class="text-center align-middle" style="width: 20%">{{ $staff->	new_glad }}</td>
                        <td class="text-center align-middle" style="width: 20%">{{ $staff->	joined_year }}</td>
                        <td class="btn-group">
                            <a href="{{ route('staff.show',['id' => $staff->id]) }}" class="btn btn-primary mr-3" role="button">詳細</a>
                            {{ Form::open(['method' => 'delete', 'route' => ['staff.destroy', $staff->id]]) }}
                                {{ Form::submit('削除',['class'=> 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center align-middle" colspan="6">登録情報がありません</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div>
        <a href={{ route('staff.new') }} class='btn btn-outline-primary'>新規登録</a>
    <div>


@endsection