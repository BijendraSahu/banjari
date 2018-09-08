{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: Retinodes-Y--}}
{{--* Date: 9/4/2017--}}
{{--* Time: 4:49 PM--}}
{{--*/--}}
@if(count($lists)>0)
    <table id="dataTable" class="display table">
        <thead>
        <tr class="bg-info">
            <th>Option</th>
            <th>Select Sentence</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $list)
            <tr>
                <td><input type="checkbox" value="{{ $list->id }}" name="sentence[]"/></td>
                <td>{{$list->sentence}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div role='alert' id='alert' class='alert alert-danger'>Sentence not available for selected location</div>
@endif