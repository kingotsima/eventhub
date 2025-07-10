@extends('layouts.app')

@section('content')
<h2>Verify OTP & Reset Password</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <div class="mb-3">
        <label>Enter OTP</label>
        <input type="text" name="otp" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button class="btn btn-primary">Reset Password</button>
</form>
@endsection
