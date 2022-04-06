<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{

    public function index()
    {
        $user = User::where('role', 'Customer')->orderBy('name')->get();

        $data = array(
            'data' => $user
        );

        return view('pelanggan.index', $data);
    }
}
