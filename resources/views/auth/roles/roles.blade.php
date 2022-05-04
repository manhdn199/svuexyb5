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
        </tr>
        @foreach($role as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->name  }}</td>
            <td>
                <a href="{{ route('edit',$value->id) }}"> Edit</a>
                <a onclick="return confirm('Do u want delete?')" href="{{route('delete',$value->id)}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</form>
