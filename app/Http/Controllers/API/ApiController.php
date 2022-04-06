<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllRekomendasi()
    {
        $data = Rekomendasi::all();

        $result = [
            'data' => $data,
        ];

        return $result;
    }

    public function getRekomendasiById($id)
    {
        $data = Rekomendasi::find($id);

        $result = [
            'data' => $data,
        ];

        return $result;
    }
}
