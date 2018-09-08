{!! Form::open(['url'=>'_gldNR/'.$lead->id, 'id'=>'frmNoReponse']) !!}
@include('includes.communication_modal')
<div class="container">
{{--<div class="form-group">--}}
    {{--{!! Form::label('reponse', 'Response', ['class' => 'col-sm-2 control-label']) !!}--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::label('response', 'Negative', ['class' => 'form-control textWithSpace', 'placeholder'=>'Response','id'=>'txtResponse']) !!}--}}
    {{--</div>--}}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Send Response', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!!Form::close()!!}
<script src="{{ url('assets/js/validation.js') }}"></script>

{{--<script>--}}
{{--$("#btnFollowUp").click(function () {--}}
{{--var id = '{{$lead->id}}';--}}
{{--var communication = $('#txtCommunication').val();--}}
{{--var response = $('#txtResponse').val();--}}
{{--var lastvisiteddate = $('#lastVisitedDate').val();--}}
{{--$.ajax({--}}
{{--type: "post",--}}
{{--contentType: "application/json; charset=utf-8",--}}
{{--url: "{{ url('_gldNR') }}",--}}
{{--data: '{"id":"' + id + '","communication":"' + communication + '","response":"' + response + '","last_visited_date":"' + lastvisiteddate + '"}',--}}
{{--//dataType: "json",--}}
{{--success: function (data) {--}}
{{--window.location = 'home_counsellor';--}}
{{--},--}}
{{--error: function (xhr, status, error) {--}}
{{--$('.modal-body').html(xhr.responseText);--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--</script>--}}