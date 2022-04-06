@extends('layouts.template')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Riwayat</h1>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form class = "form-inline" action="{{ route('riwayat.show') }}" method="get">
              <div class = "input-group mt-2">
                <select name = "tahun" id = "tahun">
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                </select>

                <div class = "input-group mt-2 ml-2">
                  <select name = "bulan" id = "bulan">
                    <option value ="0">Pilih Bulan : </option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                  <input type="submit" value="Submit" class="btn btn-success ml-2">
              </div>
        </div>
          @if (isset($data))
          @php
          $date = DateTime::createFromFormat('Y-m-d', $data->tanggal);
          $month = $date->format('Y-m');
          @endphp
          <table class = "table table-bordered mt-5">
            <tr>
              <th>Tanggal</th>
              <td>{{ $month }}</td>
            </tr>
            <tr>
              <th>Pendapatan</th>
              <td>Rp.{{ number_format($data->pendapatan, 2, ',' , '.') }}</td>
            </tr>
            <tr>
              <th>Kebutuhan Produksi</th>
              <td>Rp.{{ number_format($data->kebutuhan_produksi, 2, ',', '.') }}</td>
            </tr>
            <tr>
              <th>Keuntungan</th>
              <td>Rp.{{ number_format($data->keuntungan, 2, ',', '.') }}</td>
            </tr>
          </table>             
          @endif
            </form>
      </div>

</div>
@endsection


