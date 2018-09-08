@extends('layout.master.master')

@section('title', 'Change Password')

@section('content')
    <h4>Change Password</h4>
    <hr/>
    @if($errors->any())
        <div role="alert" id="alert" class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    {!! Form::open(['url' => 'change_password', 'class' => 'form-horizontal', 'id'=>'frm']) !!}
    <div class="form-group">
        {!! Form::label('current_password', 'Current Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('current_password', ['class' => 'form-control input-sm required', 'placeholder'=>'Current Password']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('new_password', 'New Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('new_password', ['class' => 'form-control input-sm required', 'placeholder'=>'New Password']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('confirm_password', ['class' => 'form-control input-sm required', 'placeholder'=>'Confirm Password']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@stop