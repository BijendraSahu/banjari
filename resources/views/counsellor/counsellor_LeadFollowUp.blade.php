<script src="{{ url('assets/js/validation.js') }}"></script>
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
{!! Form::open(['url'=>'_gflwup/'.$lead->id, 'id'=>'frmFollowup']) !!}

@include('includes.communication_modal')
<div class="container">
    <div class="form-group">
        {!! Form::label('visited_date', 'NextFollowup Date', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <input id="next_followup_date" name="next_followup_date" class="form-control dtp2 input-sm required"
                   type="text" placeholder="Select Date"  autocomplete="off"/>
            {{--<input class="form-control birthday fnt" name="birthday" type="date" value=""--}}
            {{--id="example-date-input">--}}
            {{--<input class="form-control" type="datetime-local" value=""--}}
            {{--id="example-datetime-local-input">--}}
        </div>
    </div>
    <p class="clearfix"></p>
    <div class="form-group">
        {!! Form::label('reponse', 'Response', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('response', 'Neutral', ['class' => 'form-control textWithSpace', 'placeholder'=>'Response','id'=>'txtResponse']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Send Response', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!!Form::close()!!}

<script>
    $(function () {
        $('.dtp2').datepicker({
            format: "dd-M-yyyy",
//            maxViewMode: 5,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

