@include('includes.deletion_body')
{{--<h4>success</h4>--}}
<script>
    $("#btnDelete").click(function(){
        $.ajax({
            type: "post",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('enquiry/'.$enquiry->id.'/delete') }}",
//            data: '{"data":"' + id + '"}',
            //dataType: "json",
            success: function (data) {
//                alert(data);
                window.location = 'enquiry';
            },
            error: function (result) {
                $('.modal-body').html("Technical Error Occurred");
            }
        });
    });
</script>