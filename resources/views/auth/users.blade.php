<form action="" method="post">
    @csrf
    @if(!empty($error))
        <span>
        <strong>
            {{ $error->first('error') }}
        </strong>
        </span>
    @endif
    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>gender</td>
            <td>Birthday</td>
            <td>Tel</td>
            <td>Address</td>
            <td>Action</td>
        </tr>
        @foreach($user as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->name  }}</td>
            <td>{{ $value->email  }}</td>
            <td>@if($value->gender == 1)
                Male
                @elseif($value->gender == 2)
                Female
                @else
                Other
                    @endif

            </td>
            <td>{{ $value->birthday  }}</td>
            <td>{{ $value->tel  }}</td>
            <td>{{ $value->address  }}</td>
            <td>
                <a href="{{ route('edit',$value->id) }}"> Edit</a>
                <a onclick="return confirm('Do u want delete?')" href="{{route('delete',$value->id)}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</form>
