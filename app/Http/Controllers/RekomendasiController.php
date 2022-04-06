<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use File;


class RekomendasiController extends Controller
{
    private $params;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['rekomendasi'] = Rekomendasi::orderBy('judul_menu')->get();
        return view('rekomendasi.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekomendasi.create');
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
            'judul_menu' => 'required',
            'bahan' => 'required',
            'langkah' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'judul_menu' => 'Judul Menu',
            'bahan' => 'Bahan-bahan',
            'langkah' => 'Langkah-langkah',
        ]);

        $newRekomendasi = new Rekomendasi;
        $newRekomendasi->judul_menu = $request->judul_menu;
        $newRekomendasi->bahan = $request->bahan;
        $newRekomendasi->langkah = $request->langkah;
        if ($request->file('foto') != null) {
            $folder = 'upload/menu';
            $file = $request->file('foto');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            // Get canonicalized absolute pathname
            $path = realpath($folder);

            // If it exist, check if it's a directory
            if (!($path !== true and is_dir($path))) {
                // Path/folder does not exist then create a new folder
                mkdir($folder, 0755, true);
            }
            if ($file->move($folder, $filename)) {
                $newRekomendasi->gambar = $folder . '/' . $filename;
            }
        }
        $newRekomendasi->save();

        return redirect('rekomendasi')->withStatus('Berhasil menyimpan data.');
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
        $this->params['rekomendasi'] = Rekomendasi::find($id);
        return view('rekomendasi.edit', $this->params);
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
            'judul_menu' => 'required',
            'bahan' => 'required',
            'langkah' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'judul_menu' => 'Judul Menu',
            'bahan' => 'Bahan-bahan',
            'langkah' => 'Langkah-langkah',
        ]);


        $editRekomendasi = Rekomendasi::find($id);
        $editRekomendasi->judul_menu = $request->judul_menu;
        $editRekomendasi->bahan = $request->bahan;
        $editRekomendasi->langkah = $request->langkah;
        if ($request->file('foto') != null) {
            if (file_exists($editRekomendasi->gambar)) {
                File::delete($editRekomendasi->gambar);
            }
            $folder = 'upload/menu';
            $file = $request->file('foto');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            // Get canonicalized absolute pathname
            $path = realpath($folder);

            // If it exist, check if it's a directory
            if (!($path !== true and is_dir($path))) {
                // Path/folder does not exist then create a new folder
                mkdir($folder, 0755, true);
            }
            if ($file->move($folder, $filename)) {
                $editRekomendasi->gambar = $folder . '/' . $filename;
            }
        }
        $editRekomendasi->save();

        return redirect('rekomendasi')->withStatus('Berhasil memperbarui data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Rekomendasi::findOrFail($id);
        if ($data->gambar != null) {
            if (file_exists($data->gambar)) {
                File::delete($data->gambar);
            }
        }
        $data->delete();

        return back()->withStatus('Berhasil menghapus data.');
    }
}
