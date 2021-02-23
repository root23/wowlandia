<?php

namespace App\Http\Controllers\Web\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:60',
            'text' => 'required|min:3|max:255',
            'email' => 'required|email',
        ]);

        $review = new Review();

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                   'name' => 'string|max:255',
                   'image' => 'mimes:jpeg,png|max:1014',
                ]);
                $extension = $request->file->extension();
                $filename = uniqid();
                $request->file->storeAs('/public/reviews/', $filename . "." . $extension);
                $url = Storage::url('reviews/' . $filename.".".$extension);
                $review->image = $url;
                $review->is_active = 0;
                $review->product_id = $request->get('product_id');
                $review->email = $request->get('email');
                $review->message = $request->get('text');
                $review->rating = $request->get('rating');
                $review->title = $request->get('name');
                $review->save();
                Session::flash('success', "Success!");
            }
        }

        return redirect('/')->with('status', 'review-added');

    }
}
