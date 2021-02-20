<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class CartUpdateRequest extends Request {
    public function rules() {
        return [
            'action' =>'required',
            'X-CSRF-TOKEN' => 'required',
        ];

    }
}
