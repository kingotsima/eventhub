<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $details = [
            'name' => auth()->user()->name,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ];

        try {
            Mail::to('EventHub1000@gmail.com')->send(new \App\Mail\ContactMessage($details));
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (Exception $e) {
            Log::error('Mail send failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Message could not be sent. Please check your internet and try again.');
        }
    }
}

