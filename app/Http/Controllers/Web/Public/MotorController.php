<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index()
    {
        // Untuk testing: Kirim pesan teks saja
        return view('pages.motor.motor-view');
    }
}