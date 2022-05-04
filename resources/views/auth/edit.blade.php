
<form method="POST" action="{{route('edit',$user->id)}}">
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required value="{{$user->password}}">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

        <div class="col-md-6">
            <select name="gender" id="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

        <div class="col-md-6">
            <input id="birthday" type="date" class="form-control" name="birthday" required value="{{ $user->birthday }}">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Tel') }}</label>

        <div class="col-md-6">
            <input id="tel" type="number" class="form-control" name="tel" required value="{{ $user->tel }}">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" required value="{{ $user->address }}">
        </div>
    </div>

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
