
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
                    <input type="text" name="username" value="{{$value->userName}}">
                </td>
                <td>
                    <input type="text" name="projectName" value="{{$value->projectName}}">
                </td>
            </tr>
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
