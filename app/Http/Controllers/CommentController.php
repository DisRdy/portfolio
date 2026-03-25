<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\RateLimiter;

class CommentController extends Controller
{
    /**
     * Show the form and the list of comments.
     */
    public function index()
    {
        $comments = Comment::latest()->get();

        // Rate Limiting Info
        $ip = request()->ip();
        $key = 'send-comment:' . $ip;
        $maxAttempts = 5;
        $remaining = RateLimiter::remaining($key, $maxAttempts);

        return view('comments', compact('comments', 'remaining', 'maxAttempts'));
    }

    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        $ip = $request->ip();
        $key = 'send-comment:' . $ip;
        $maxAttempts = 5; // 5 comments per hour? or day? Let's say per hour for now or generic decay
        $decaySeconds = 3600;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()->with('error', 'Terlalu banyak percobaan. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        Comment::create($data);

        RateLimiter::hit($key, $decaySeconds);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }
}
