
<form method="POST" action="{{ route('addUserHasProject') }}">
    @csrf

    <table>
        <tr>
            <td>
                User
            </td>
            <td>
                Project
            </td>
        </tr>
        @foreach( $userHasProject as $value)
            <tr>
                <td>
                    <input type="text" name="user_id" value="{{$value->userName}}">
                </td>
                <td>
                    <input type="text" name="project_id" value="{{$value->projectName}}">
                </td>
            </tr>
        @endforeach
    </table>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Add
            </button>
            <button href="{{ route('users') }}">
                Back
            </button>
        </div>
    </div>
</form>
