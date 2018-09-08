<div class="row">
    <div class="col-md-12">
        <div class="thumbnail">
            <div class="caption">
                {{--<button type="button" id="{{ $tour_info->id }}"--}}
                {{--class="btn btn-sm btn-danger btn-xs btnDelete btnSet pull-right" title="Delete"><span--}}
                {{--class="fa fa-trash-o" aria-hidden="true"></span>Remove--}}
                {{--</button>--}}
                <h3 class="bg-info text-center">Selected Day Description</h3>
                <p class="clearfix"></p>
                <h5><b>DAY:</b>
                    @if($tour_info->sentence_master_id != null)  {{$tour_info->sentence_master->sentence}}
                    @endif
                </h5>
                <hr>
                @if($tour_info->hotel_master_id != null)
                    <h3 class="text-center">HOTEL:
                        {{$tour_info->hotel_master->hotel_name}}
                    </h3>
                    <table id="dataTable" class="display table">
                        <thead>
                        <tr class="bg-info">
                            <th>Room Type & Inclusion</th>
                            <th>Room Rate</th>
                            <th>No of Room Use</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tour_event_info as $event)
                            {{--                                    @foreach($event as $item)--}}
                            <tr>
                                <td>{{$event->hotel_info->room_type}}</td>
                                <td><i class="fa fa-inr"></i> {{$event->hotel_info->rate}}</td>
                                <td>{{$event->room_count}}</td>
                                <td><i class="fa fa-inr"></i> {{$event->hotel_info->rate*$event->room_count}}</td>
                            </tr>
                            {{--@endforeach--}}
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

{{--<script>--}}
{{--$(".viewinfo").click(function () {--}}
{{--var id = $(this).attr('id');--}}
{{--//        console.log(id);--}}
{{--$.ajax({--}}
{{--type: "POST",--}}
{{--contentType: "application/json; charset=utf-8",--}}
{{--url: "{{ url('_vevent') }}",--}}
{{--data: '{"data":"' + id + '"}',--}}
{{--success: function (data) {--}}
{{--$('#hotelinfo').html(data);--}}
{{--},--}}
{{--error: function (xhr, status, error) {--}}
{{--alert('xhr.responseText');--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--</script>--}}
{{--@foreach($tour_event as $event)--}}
{{--<div class="row">--}}
{{--@if(count($itinerary_info) != 0)--}}
{{--@foreach($itinerary_info as $tour_info)--}}
{{--{{$tour_info->category}}--}}
{{--@endforeach--}}
{{--@foreach($tour_event as $event)--}}
{{--{{$event->hotel_master_id}}--}}
{{--@endforeach--}}
{{--@endif--}}
{{--<div class="col-md-12">--}}
{{--<div class="thumbnail">--}}
{{--<img alt="300x200" src="http://lorempixel.com/600/200/sports">--}}
{{--<div class="caption">--}}
{{--<h3>--}}
{{--Rocky--}}
{{--</h3>--}}
{{--<p>--}}
{{--Loves catnip and naps. Not fond of children.--}}
{{--</p>--}}
{{--<p>--}}

{{--</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endforeach--}}