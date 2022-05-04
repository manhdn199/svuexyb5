
<form method="POST" action="{{ route('addUserHasRole') }}">
    @csrf

    <div class="row mb-3">
        <table>
            <tr>
                <td>
                    Name
                </td>
                <td>
                    Role
                </td>
            </tr>
            @foreach($userHasRole as $value)
                <tr>
                    <td>
                        {{$value->userName}}
                    </td>
                    <td>
                        {{$value->roleName}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button href="{{ route('users') }}">
                Home
            </button>
        </div>
    </div>
</form>
