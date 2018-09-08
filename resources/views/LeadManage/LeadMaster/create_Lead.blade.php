{{--@extends('layout.master.master')--}}

{{--@section('title', 'Add Lead')--}}

{{--@section('content')--}}
<script src="{{ url('assets/js/validation.js') }}"></script>


{{--@if($enq != null)--}}
{{--{{ Form::model($enq, array('route' => array('lead.store'), 'method'=>'POST')) }}--}}
{{--<div class="form-group hidden">--}}
{{--{!! Form::label('enqId', 'Hidden_ID', ['class' => 'col-sm-2 control-label']) !!}--}}
{{--<div class="col-sm-9">--}}
{{--</div>--}}
{{--</div>--}}
{{--@else--}}
{{--@endif--}}

{!! Form::open(['url'=>'lead', 'id'=>'frmLead']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('role', 'Select Executive *', ['class' => 'col-sm-3 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('user_master_id', $users, null,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('enqId', $enq->id, ['class' => 'form-control hidden', 'placeholder'=>'Hidden_ID']) !!}
            {!! Form::text('name', $enq->name, ['class' => 'form-control textWithSpace required', 'placeholder'=>'Name']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('name', 'Contact', ['class'=>'col-sm-3 form-label']) !!}
        <div class="col-sm-9">
            {{ Form::text('contact', $enq->contact, ['class' => 'form-control numberOnly required', 'placeholder'=>'Contact']) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('name', 'Email', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('email', $enq->email, ['class' => 'form-control', 'placeholder'=>'Email']) !!}
        </div>
    </div>

    {{--<div class="form-group">--}}
    {{--{!! Form::label('name', 'Address', ['class' => 'col-sm-3 control-label']) !!}--}}
    {{--<div class="col-sm-9">--}}
    {{--{!! Form::text('address', null, ['class' => 'form-control', 'placeholder'=>'Address']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="form-group">
        {!! Form::label('name', 'Communication', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('communication', null, ['class' => 'form-control', 'placeholder'=>'Communication']) !!}
        </div>
    </div>

    {{--<div class="form-group">--}}
    {{--{!! Form::label('name', 'Last Visited Date', ['class' => 'col-sm-3 control-label']) !!}--}}
    {{--<div class="col-sm-9">--}}
    {{--{!! Form::text('lastVisitedDate', null, ['class' => 'form-control', 'placeholder'=>'Last Visited Date']) !!}--}}
    {{--<div id="dtplastVisitedDate" class="input-group dtp">--}}
    {{--<input id="lastVisitedDate" name="lastVisitedDate" class="form-control input-sm"--}}
    {{--type="text"--}}
    {{--placeholder="Select Date"/>--}}
    {{--<span class="add-on input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--@if($enq == null)--}}
    {{--<div class="form-groups">--}}
    {{--{!! Form::label('name', 'Select Enquiry',['class'=>'col-sm-3 control-label']) !!}--}}
    {{--<div class="col-sm-9">--}}
    {{--@if(!is_null($enquiries))--}}
    {{--{!! Form::select('enquiry_id', $enquiries, null,['class' => 'form-control requiredDD']) !!}--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endif--}}

    {{-- USER ID FROM SESSION --}}

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{--<button class="btn btn-default" formnovalidate="formnovalidate" onclick="javascript:history--}}
            {{--.back();"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back--}}
            {{--</button>--}}
            {{ Form::submit('Submit',['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>

{!! Form::close() !!}
{{--@stop--}}