@extends('layout')

@section('content')
    <h1>社員変更</h1>
    {{ Form::model($staff_paramertar, ['route' => ['staff.update',$staff_paramertar->id]]) }}
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">社員コード</label>
            {{ Form::label("staff_code", $staff_paramertar->staff_code, ["class" => "col-sm-2 col-form-label"]) }}
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">姓</label>
            <div class="col-sm-10">
                {{ Form::text("last_name", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('last_name'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('last_name') }}</li>
            </div>
        @endif 

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">名</label>
            <div class="col-sm-10">
                {{ Form::text("first_name", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('first_name'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('first_name') }}</li>
            </div>
        @endif 

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">姓(ローマ字)</label>
            <div class="col-sm-10">
                {{ Form::text("last_name_romaji", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('last_name_romaji'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('last_name_romaji') }}</li>
            </div>
        @endif

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">名(ローマ字)</label>
            <div class="col-sm-10">
                {{ Form::text("first_name_romaji", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('first_name_romaji'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('first_name_romaji') }}</li>
            </div>
        @endif

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">メールアドレス</label>
            <div class="col-sm-10">
                {{ Form::text("mail_address", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('mail_address'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('mail_address') }}</li>
            </div>
        @endif 

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">新卒入社</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    {{ Form::checkbox("new_glad_flg", "1", old('new_glad_flg',$staff_paramertar->new_glad_flg) == "1"? 'checked':'', ["class" => "form-check-input"]) }}
                    <label class="form-check-label">新卒</label>
                </div>
            </div>
        </div>
        @if($errors->has('new_glad_flg'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('new_glad_flg') }}</li>
            </div>
        @endif

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">所属</label>
            <div class="col-sm-10">
                {{Form::select('staff_department',$job_list, old('staff_department',$staff_paramertar->staff_department)
                ,['class' => 'form-control', 'placeholder' => '選択してください', "selected" => old('staff_department', $staff_paramertar->staff_department) ? "selected" : "" ])}}
            </div>
        </div>
        @if($errors->has('staff_department'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('staff_department') }}</li>
            </div>
        @endif

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">入社日</label>
            <div class="col-sm-10">
                {{ Form::date('joined_year',null) }}
            </div>
        </div>
        @if($errors->has('joined_year'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('joined_year') }}</li>
            </div>
        @endif

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">案件</label>
            <div class="col-sm-10">
                {{ Form::textarea("project_type", null, ["class" => "form-control"]) }}
            </div>
        </div>
        @if($errors->has('project_type'))
            <div class="alert alert-danger">
                <li>{{ $errors->first('project_type') }}</li>
            </div>
        @endif

        <div class="text-center">
            <div class="btn-group">
            {{ Form::submit('更新', ['class' => 'btn btn-primary']) }}
                <a href="{{ route('staff.show',['id' => 1]) }}" class="btn btn-primary ml-3" role="button">戻る</a>
            {{ Form::close() }}
            </div>
        </div>

@endsection