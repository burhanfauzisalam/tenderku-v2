<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TokenController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect ke login
        }
        $user = Auth::user();
        return view('tokens.index');
    }
}
