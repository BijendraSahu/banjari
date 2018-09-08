{{--<input type="checkbox" value="{{ $list->id }}" name="list[]"/>--}}
{{--<strong>{{ $list->room_type ." Rs.".  $list->rate}}</strong> <br>--}}
<script src="{{ url('assets/js/validation.js') }}"></script>

<table id="dataTable" class="display table">
    <thead>
    <tr class="bg-info">
        <th>Option</th>
        <th>Room Type & Inclusion</th>
        <th>Room Rate</th>
        <th>No of Room</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lists as $list)
        <tr>
            <td><input type="checkbox" value="{{ $list->id }}" class="list" name="list[]"/></td>
            <td>{{$list->room_type}}</td>
            <td><i class="fa fa-inr"></i> {{ $list->rate}}</td>
            {{--<td><input type="text" name="room_no[]" value="1" maxlength="1" placeholder="No of Rooms"></td>--}}
            <td><input type="text" name="room_no[]" value="1" maxlength="2" placeholder="No of Rooms"></td>
        </tr>
    @endforeach
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function () {
        $("input[name='room_no[]']").prop('disabled', true);
        $(".list").click(function () {
            if ($(this).prop("checked") == true) {
                $(this).closest('tr').find('input:text').prop('disabled', false, this.checked);
            }
            else if ($(this).prop("checked") == false) {
                $(this).closest('tr').find('input:text').prop('disabled', true, this.checked);
            }
        });
    });
</script>