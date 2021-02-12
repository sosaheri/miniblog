<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AppController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('mood', 'DESC')->get();

        return view('welcome', ['posts' => $posts]);
    }

    public function dashboard()
    {

        return view('dashboard');
    }



}
