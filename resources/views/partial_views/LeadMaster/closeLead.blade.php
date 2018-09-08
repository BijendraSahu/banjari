<script>
    $('#myModal .modal-title').html('Close Following Lead');
    //    $('#modelBtn').html('<button type="submit" class="btn btn-success" id="btnDelete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Confirm</button>');
</script>
<div class="container">
    <h4>Are You Sure ?</h4>
    <button type="button" name="btnDelete" id="btnDelete" class="btn btn-danger">Close/Complete Lead</button>
</div>
<script>
    $('#btnDelete').click(function () {
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('_clsLeadCfm/'.$lead->id.'/close')}}",
            data: '{"data":"}',
            //dataType: "json",
            success: function (data) {
                window.location = 'lead';
//                $('.modal-body').html(data);
            },
            error: function (result) {
                $('.modal-body').html("Technical Error Occurred");
            }
        });
    });
</script>