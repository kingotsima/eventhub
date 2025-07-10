@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
    <div class="text-center">
        <div class="text-yellow-500 mb-6">
            <!-- Triangle with sad face emoji -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill="currentColor" d="M12 2L2 22h20L12 2z" />
                <circle cx="9" cy="10" r="1" fill="black"/>
                <circle cx="15" cy="10" r="1" fill="black"/>
                <path d="M9 16c1.5-1 4.5-1 6 0" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">No Internet Connection</h1>
        <p class="mt-2 text-gray-600">Please connect to the internet and try again.</p>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ⟳ Try Again
        </a>
    </div>
</div>
@endsection
