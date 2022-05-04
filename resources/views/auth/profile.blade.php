
<form method="POST" action="{{ route('editProfile') }}">
    @csrf

    <table>
        <tr>
            <td>
                <input type="text" name="name" value="{{$user->name}}">
            </td>
            <td>
                <input type="text" name="email" value="{{$user->email}}">
            </td>
            <td>
                <input id="password" type="password" name="password" value="{{$user->password}}">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

            </td>
            <td>
                <input type="radio" name="gender" value="1">
                <label for="1">Male</label><br>
                <input type="radio" name="gender" value="2">
                <label for="2">Female</label><br>
                <input type="radio" name="gender" value="3">
                <label for="3">Other</label><br>
            </td>
            <td>
                <input type="date" name="birthday" value="{{$user->birthday}}">

            </td>
            <td>
                <input type="text" name="tel" value="{{$user->tel}}">
            </td>
            <td>
                <input type="text" name="address" value="{{$user->address}}">
            </td>

        </tr>
    </table>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
            <button href="{{ route('users') }}">
                Back
            </button>
        </div>
    </div>
</form>
