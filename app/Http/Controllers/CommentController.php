<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Foydalanuvchini tekshirish
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Kommentariya qoldirish uchun ro\'yxatdan o\'ting.');
        }

        // Izohni saqlash
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Izohingiz muvaffaqiyatli qo\'shildi!');
    }
}

