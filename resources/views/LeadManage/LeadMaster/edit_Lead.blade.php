{{--@extends('layout.master.master')--}}

{{--@section('title', 'Edit Lead Info.')--}}

{{--@section('content')--}}
<script src="{{ URL::asset('js/validation.js') }}"></script>

    <div>
        {{--<h4>Edit {{ $lead->name }}</h4>--}}
        {!! Form::open(['url'=>'lead/'.$lead->id, 'id'=>'frmeditLead','method'=>'PUT']) !!}
        {{--{{ Form::model($lead, array('route' => array('lead.update', $lead->id), 'method'=>'PUT')) }}--}}

        <div class="form-group">
            {!! Form::label('name', 'Person Name', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', $lead->name, ['class' => 'form-control textWithSpace required', 'placeholder'=>'Person Name']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Contact', ['class'=>'col-sm-2 form-label']) !!}
            <div class="col-sm-10">
                {{ Form::text('contact', $lead->contact, ['class' => 'form-control numberOnly required', 'placeholder'=>'Contact']) }}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Email', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('email', $lead->email, ['class' => 'form-control', 'placeholder'=>'Email']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Address', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('address', $lead->address, ['class' => 'form-control', 'placeholder'=>'Address']) !!}
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--{!! Form::label('name', 'Communication', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class="col-sm-10">--}}
                {{--{!! Form::textarea('communication', $lead->communication, ['class' => 'form-control', 'placeholder'=>'Communication']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{!! Form::label('name', 'Last Visited Date', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class="col-sm-10">--}}
                {{--<div id="dtplastVisitedDate" class="input-group dtp">--}}
                    {{--<input id="lastVisitedDate" name="lastVisitedDate" class="form-control input-sm"--}}
                           {{--type="text" placeholder="Select Date" value="{{ $lead->last_visited_date }}"/>--}}
                    {{--<span class="add-on input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
    {{ Form::close() }}
{{--@stop--}}
