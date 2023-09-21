<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class blogController extends Controller
{
  
    public function index()
    {

        return view('home.blog');
    }
}
