<form action="" method="post">
    @csrf

    <table>
        <tr>
            <td>Detail</td>
            <td>
                Project
            </td>
            <td>
                Working_time
            </td>
            <td>
                Working_type
            </td>
            <td>
                Time
            </td>
            <td>
                Status
            </td>
            <td>
                Action
            </td>
        </tr>
        @foreach( $reports as $value)
            <tr>
                <td>
                    <span>
                        {{ $value->detail }}
                    </span>
                </td>
                <td>
                    <span>
                        {{ $value->projectName }}
                    </span>
                </td>
                <td>
                    <span>
                        {{ $value->working_time }}
                    </span>
                </td>
                <td>
                    <span>
                        {{ $value->working_type }}
                    </span>
                </td>
                <td>
                    <span>
                        {{ $value->time }}
                    </span>
                </td>
                <td>
                    <span style="color: yellow">
                        {{$value->status}}
                    </span>
                </td>
                <td>
                    @if($value->status = 'waiting')
                        <a href="{{route('editReport',$value->id)}}">Edit</a>
                        <a href="{{route('deleteReport',$value->id)}}">Delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</form>
