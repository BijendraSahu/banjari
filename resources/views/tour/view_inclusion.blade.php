<div class="row">
    <div class="col-md-12">
        <div class="thumbnail">
            <div class="caption">
                <h3 class="bg-info text-center">Inclusions Description</h3>
                <hr>
                <table id="dataTable" class="display table">
                    <thead>
                    <tr class="bg-info">
                        <th>Inclusion</th>
                        <th>Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inclusions as $inclusion)
                        {{--                                    @foreach($event as $item)--}}
                        <tr>
                            <td>{{$inclusion->inclusion_master->name}}</td>
                            <td><i class="fa fa-inr"></i> {{$inclusion->inclusion_master->rate}}</td>
                        </tr>
                        {{--@endforeach--}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>