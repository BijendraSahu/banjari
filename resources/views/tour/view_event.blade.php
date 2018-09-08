@if(count($tour_info_details))
    @foreach($tour_info_details as $details)
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail">
                    <div class="caption">
                        <h3 class="bg-info text-center">{{$details->category}}</h3>
                        <h4><b>Title: {{$details->title}}</b></h4>
                        <h5><p class="badge" style="font-size: 15px;">{{$details->type}}</p>
                            By {{$details->vehicle_master->vehicle_name}} {{$details->vehicle_master->seat}}
                            Rs.{{$details->vehicle_master->rate}}
                            <p><b>Notes:</b> {{$details->notes}}</p>
                        </h5>
                        <hr>
                        @if($details->hotel_master_id != null)
                            <h3 class="text-center">HOTEL:
                                {{$details->hotel_master->hotel_name}}
                            </h3>
                            <table id="dataTable" class="display table">
                                <thead>
                                <tr class="bg-info">
                                    <th>Room Type & Inclusion</th>
                                    <th>Room Rate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tour_event as $event)
                                    @foreach($event as $item)
                                        <tr>
                                            <td>{{$item->hotel_info->room_type}}</td>
                                            <td><i class="fa fa-inr"></i> {{$item->hotel_info->rate}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div role='alert' id='alert' class='alert alert-danger'>No Event Found In Selected Day</div>
@endif

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
{{--@if(count($tour_info_details) != 0)--}}
{{--@foreach($tour_info_details as $details)--}}
{{--{{$details->category}}--}}
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