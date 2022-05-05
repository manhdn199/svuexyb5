<form action="{{route('addReport')}}" method="post">
    @csrf

    <input type="hidden" name="user_id" value="{{$user->id}}">
    Detail
    <input type="text" name="detail" value="" required>
    <br>
    Working_time
    <input type="date" name="working_time" required>
    <br>
    Working_type
    <select name="working_type" id="">
        @foreach($positions as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
    <br>
    Project
    <select name="working_type" id="" required>
        @foreach($project as $value)
            <option value="{{ $value->idProject }}">{{ $value->projectName }}</option>
        @endforeach
    </select>
    <br>
    Time
    <input type="number" name="time" required>
    <br>
    <input type="submit" value="submit">
</form>
