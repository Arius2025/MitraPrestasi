<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Lomba;
use App\Models\Kategori;
use Illuminate\Http\Request;
class LandingController extends Controller
{
    
    public function index(Request $request)
    {
        $blogs = Blog::whereNotNull('published_at')->latest()->take(3)->get();
        $lombas = Lomba::latest()->take(3)->get();
        $categories = Kategori::all();
        return view('welcome', [
            'blogs' => $blogs,
            'lombas' => $lombas,
            'categories' => $categories,
        ]);
        
    }
    
}