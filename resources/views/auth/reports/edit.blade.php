<form action="{{route('editReport',$report->id)}}" method="post">
    @csrf
    {{--    @dd($report)--}}
    <input type="hidden" name="id" value="{{$report->id}}">

    Detail
    <input type="text" name="detail" value="{{$report->detail}}">
    Project
    <select name="project" id="">
        @foreach( $project as $value)
            @if($value->idProject == $report->project_id)
                <option value="{{$value->idProject}}" selected>{{$value->projectName}}</option>
            @else
                <option value="{{$value->idProject}}">{{$value->projectName}}</option>
            @endif
        @endforeach
    </select>
    Working_Time
    <input type="date" name="working_time" value="{{$report->working_time}}">
    Working_Type
    <select name="working_type" id="">
        @foreach( $positions as $value)
            @if($value->name == $report->working_type)
                <option value="{{$report->working_type}}" selected>{{$report->working_type}}</option>
            @else
                <option value="{{$value->name}}">{{$value->name}}</option>
            @endif
        @endforeach
    </select>
    Time
    <input type="number" name="time" value="{{$report->time}}">
    <input id="update" type="submit" value="update" disabled="">

</form>
<button onclick="history.back()">Go Back</button>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="exponential.js"></script>
<script>
    var button = $('#update');
    var orig = [];

    $.fn.getType = function () {
        return this[0].tagName == "INPUT" ? $(this[0]).attr("type").toLowerCase() : this[0].tagName.toLowerCase();
    }

    $("form :input").each(function () {
        var type = $(this).getType();
        var tmp = {
            'type': type,
            'value': $(this).val()
        };
        if (type == 'radio') {
            tmp.checked = $(this).is(':checked');
        }
        orig[$(this).attr('id')] = tmp;
    });

    $('form').bind('change keyup', function () {

        var disable = true;
        $("form :input").each(function () {
            var type = $(this).getType();
            var id = $(this).attr('id');

            if (type == 'text' || type == 'select') {
                disable = (orig[id].value == $(this).val());
            } else if (type == 'radio') {
                disable = (orig[id].checked == $(this).is(':checked'));
            }

            if (!disable) {
                return false; // break out of loop
            }
        });

        button.prop('disabled', disable);
    });
</script>

