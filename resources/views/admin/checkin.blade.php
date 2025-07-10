@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Event Check-In</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Manual Entry Form --}}
    <form method="POST" action="{{ route('admin.checkin') }}" id="checkinForm">
        @csrf
        <div class="form-group">
            <label for="booking_code">Booking Code:</label>
            <input type="text" name="booking_code" id="booking_code" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Check In</button>
    </form>

    <hr class="my-4">

    {{-- QR Code Scanner --}}
    <h4>Or Scan Booking QR Code</h4>
    <div id="reader" style="width: 100%; max-width: 400px;"></div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Fill the booking code and submit the form
        document.getElementById('booking_code').value = decodedText;
        document.getElementById('checkinForm').submit();
    }

    function onScanError(errorMessage) {
        // Optional: console log errors
        // console.log(errorMessage);
    }

    const html5QrCode = new Html5Qrcode("reader");
    const config = { fps: 10, qrbox: 250 };

    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            html5QrCode.start(
                cameras[0].id,
                config,
                onScanSuccess,
                onScanError
            );
        } else {
            alert("No camera found for QR scanning.");
        }
    }).catch(err => {
        console.error("Camera access error: ", err);
    });
</script>
@endsection
