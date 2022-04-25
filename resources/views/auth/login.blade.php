@if (!empty($errors))
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-danger"> {{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('status'))
    <ul>
        <li class="text-danger"> {{ session('status') }}</li>
    </ul>
@endif
<form action="{{ route('getLogin') }}" method="post">
    {{ csrf_field() }}
    <input type="email" class="form-control" name="email" placeholder="Email">
    <input type="password" class="form-control" placeholder="Password" name="password">
    <button type="submit" name="submit">Sign In</button>
</form>


