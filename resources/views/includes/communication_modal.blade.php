{{--Master For Lead Response --}}
<script src="{{ url('assets/js/validation.js') }}"></script>

{{--<link media="none" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>--}}
<link href="{{ url('assets/css/datepicker.css') }}" rel="stylesheet">
{{--<script src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>--}}

{{--<script>$('.dtp').datetimepicker({format: 'yyyy-MM-dd'}).on('changeDate', function (ev) {--}}
{{--});</script>--}}
<script>
    $('#myModal .modal-title').html('Lead Response');
    //        $('#modelBtn').html('<button type="submit" class="btn btn-success" id="btnFollowUp"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Send Reponse</button>');
</script>


<div class="container">
    <div class="form-group">
        {!! Form::label('communication', 'Communication', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('communication', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Communcation','rows'=>'5','id'=>'txtCommunication']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('visited_date', 'Visited Date', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <input id="last_visited_date" name="last_visited_date" class="form-control input-sm dtp1 required"
                   type="text" onkeypress="return false" autocomplete="off"
                   placeholder="Select Date"/>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.dtp1').datepicker({
            format: "dd-M-yyyy",
            maxViewMode: 2,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
