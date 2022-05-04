
<form method="POST" action="{{ route('addUserHasRole') }}">
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">User</label>

        <div class="col-md-6">
            <select name="user_id" id="">
                @foreach( $user as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name"> Role</label>

        <div class="row-cols-6">
            <select name="role_id" id="role_id">
                @foreach( $role as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

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
