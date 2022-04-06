<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Pengingat;
use App\Models\Riwayat;
use DateTime;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    private $params;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->params['pendapatan'] = Pendapatan::orderBy('tanggal', 'DESC')->get();

        return view('pendapatan.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pendapatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this_date = date('m', strtotime($request->tanggal));
        $this_year = date('Y', strtotime($request->tanggal));

        $this_month = Pendapatan::where('minggu_ke', $request->minggu)
            ->whereMonth('tanggal', $this_date)
            ->whereYear('tanggal', $this_year)
            ->get();

        $uniqueMinggu = count($this_month) > 0 ? '|unique:pendapatan,minggu_ke' : '';

        $this->validate($request, [
            'tanggal' => 'required|unique:pendapatan,tanggal',
            'pendapatan' => 'required',
            'minggu' => 'not_in:0' . $uniqueMinggu,
        ], [
            'required' => ':attribute harus diisi.',
            'not_in' => ':attribute harus dipilih.',
            'unique' => ':attribute sudah dipakai.',
        ], [
            'tanggal' => 'Tanggal',
            'pendapatan' => 'Pendapatan',
            'minggu' => 'Minggu ini',
        ]);

        if (count($this_month) > 0) {
            return back()->withError('Minggu ke ' . $request->minggu . ' di bulan ini sudah digunakan.');
        }

        $totalBarang = Pengingat::select(\DB::raw('SUM(harga / deadline) AS total'))->first()->total;

        $newPendapatan = new Pendapatan;
        $newPendapatan->tanggal = $request->tanggal;
        $newPendapatan->pendapatan = $request->pendapatan;
        $newPendapatan->keuntungan = $request->pendapatan - $totalBarang;
        $newPendapatan->minggu_ke = $request->minggu;

        $newPendapatan->save();

        $date = DateTime::createFromFormat('Y-m-d', $request->tanggal);
        $month = $date->format('m');
        $year = $date->format('Y');

        // $is4Month = Pendapatan::whereYear('tanggal', $year)->whereMonth('tanggal', $month)->count();

        if ($request->minggu == 4) {
            $totalBarangRiwayat = Pengingat::select(\DB::raw('SUM(harga / deadline * 4) AS total'))->first()->total;

            $pendapatan = Pendapatan::select(\DB::raw('SUM(pendapatan) AS total_pendapatan'), \DB::raw('SUM(keuntungan) AS total_keuntungan'))
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)->first();

            $newRiwayat = new Riwayat;
            $newRiwayat->tanggal = $request->tanggal;
            $newRiwayat->pendapatan = $pendapatan->total_pendapatan;
            $newRiwayat->kebutuhan_produksi = $totalBarangRiwayat;
            $newRiwayat->keuntungan = $pendapatan->total_keuntungan;

            $newRiwayat->save();
        }


        return redirect('kelola-keuangan/pendapatan')->withStatus('Berhasil menambah data.');
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
        $this->params['pendapatan'] = Pendapatan::find($id);

        return view('pendapatan.edit', $this->params);
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
            'tanggal' => 'required',
            'pendapatan' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            'tanggal' => 'Tanggal',
            'pendapatan' => 'Pendapatan'
        ]);
        $totalBarang = Pengingat::select(\DB::raw('SUM(harga / deadline) AS total'))->first()->total;
        $newPendapatan = Pendapatan::find($id);

        $newPendapatan->tanggal = $request->tanggal;
        $counterawal = $newPendapatan->pendapatan;
        $newPendapatan->pendapatan = $request->pendapatan;
        $newPendapatan->keuntungan = $request->pendapatan - $totalBarang;

        $newPendapatan->save();

        $date = DateTime::createFromFormat('Y-m-d', $request->tanggal);
        $month = $date->format('m');
        $year = $date->format('Y');


        $is4Month = Pendapatan::whereYear('tanggal', $year)->whereMonth('tanggal', $month)->count();

        if ($is4Month == 4) {
            $counter = $counterawal - $request->pendapatan;
            $date = DateTime::createFromFormat('Y-m-d', $request->tanggal);
            $month = $date->format('m');
            $newRiwayat = Riwayat::whereMonth('tanggal', $month)->first();
            $newRiwayat->pendapatan = $newRiwayat->pendapatan - $counter;
            $newRiwayat->keuntungan = $newRiwayat->pendapatan - $newRiwayat->kebutuhan_produksi;

            $newRiwayat->save();
        }


        return redirect('kelola-keuangan/pendapatan')->withStatus('Berhasil memperbarui data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pendapatan::findOrFail($id)->delete();

        return redirect('kelola-keuangan/pendapatan')->withStatus('Data berhasil dihapus.');
    }
}
