<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;

class LombaController extends Controller
{
    public function index()
    {
        $lombas = Lomba::latest()->get();
        return view('lomba.index', compact('lombas'));
    }

    public function show($id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('lomba.show', compact('lomba'));
    }
}

