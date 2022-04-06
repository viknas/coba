<?php

namespace App\Http\Controllers;

use App\Models\Pengingat;
use Illuminate\Http\Request;

class PengingatController extends Controller
{
    private $params;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['pengingat'] = Pengingat::get();

        return view('pengingat.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengingat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'barang' => 'required',
            'harga' => 'required',
            'deadline' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'barang' => 'Nama barang',
            'harga' => 'Harga',
            'deadline' => 'Deadline'
        ]);

        $newPengingat = new Pengingat;
        $newPengingat->barang = $request->barang;
        $newPengingat->harga = $request->harga;
        $newPengingat->deadline = $request->deadline;

        $newPengingat->save();

        return redirect('kelola-keuangan/pengingat')->withStatus('Berhasil menambah data.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['pengingat'] = Pengingat::find($id);

        return view('pengingat.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'barang' => 'required',
            'harga' => 'required',
            'awal' => 'required'
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'barang' => 'Nama barang',
            'harga' => 'Harga',
            'awal' => 'Awal Beli'
        ]);

        $pengingat = Pengingat::find($id);
        $pengingat->barang = $request->barang;
        $pengingat->harga = $request->harga;
        $pengingat->created_at = $request->awal;

        $pengingat->save();

        return redirect('kelola-keuangan/pengingat')->withStatus('Berhasil menambah data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengingat::findOrFail($id)->delete();

        return redirect('kelola-keuangan/pengingat')->withStatus('Data berhasil dihapus.');
    }
}
