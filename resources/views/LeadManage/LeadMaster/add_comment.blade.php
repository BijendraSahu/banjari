<script src="{{ url('assets/js/validation.js') }}"></script>
{{--{!! Form::open(['url'=>'lead/'.$lead->id.'/addComments', 'id'=>'frmLead']) !!}--}}

<div class="container-fluid nopadding seperate">
    {{--<div class="wraper">--}}
    <div class="col-md-12 nopadding commentbox">
        <div class="col-md-6">
            <h4><strong>Communication History</strong></h4>
            <div class="container-fluid nopadding">
                <div class="col-md-6 scrollbox" id="cmmm">
                    {!! $lead->communication !!}
                    {{--<p><b>Added By Satish:</b></p>--}}

                </div>
                <p id="error"></p>
            </div>

        </div>
        <div class="col-md-6">
            <div class="col-md-12 ">
                <div class="col-md-12">
                    <label><h4><strong>Communication</strong></h4></label>
                    {{--{!! Form::textarea('communication', null, ['class' => 'form-control required', 'placeholder'=>'Communication', 'rows'=>'5']) !!}--}}
                    <textarea id="communication" name="communication" row="5" placeholder="Enter Communication" class="form-control required"></textarea>
                    <input type="hidden" id="myid" value="{{$lead->id}}">
                    {{--<textarea rows="4" class="form-control"></textarea>--}}
                </div>
                <div class="col-md-12 seperate">
                    {{--{{ Form::submit('Submit',['class' => 'btn btn-primary']) }}--}}
                    <input type="button" onclick="senddata();" value="Submit" class="btn btn-info">
                </div>
            </div>
        </div>
        {{--</div>--}}
    </div>
</div>

{{--

{!! Form::close() !!}
--}}


   <script>
       function senddata()
       {
           var text = $('#communication').val();
           var myid = $('#myid').val();
           var editurl1 = '{{ url('lead') }}' + '/' + myid +'/' +'addComments';
           $.ajax({
               type: "POST",
               url: editurl1,
               data: "&text= " + text,
               success: function (data) {
//                   $("#myyy").load(location.href + " #myyy");
                   $('#cmmm').html(data);
//                   $('.modal-body').html($(this).parent().find('.comments').html());
               },
               error: function (xhr, status, error) {
                   alert('Server Error')
               }
           });

       }

    </script>
<script>
    $(".view-comment").click(this, function () {
        $('#myModal').modal('show');
        $('.modal-title').html('Communication Process');
        $('.modal-body').html($(this).parent().find('.comments').html());

    });
</script>