<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    private $params;

    public function index()
    {
        $this->params['ulasan'] = Ulasan::select('ulasan.*', 'users.name')
                                    ->join('users', 'users.id', 'ulasan.user')
                                    ->orderBy('ulasan.created_at')
                                    ->get();

        return view('ulasan.index', $this->params);
    }

    public function destroy($id)
    {
        Ulasan::find($id)->delete();

        return back()->withStatus('Berhasil menghapus data.');
    }
}
