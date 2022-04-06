@extends('layouts.template')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pendapatan</h1>
  <a href="{{ route('pendapatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Lihat Data
  </a>
</div>
<h7 class="m-4 text-danger">Pendapatan di input perminggu</h7>
<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Pendapatan</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form action="{{ route('pendapatan.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pendapatan">Pendapatan (Rp)</label>
                    <input type="number" name="pendapatan" id="pendapatan" class="form-control @error('pendapatan') is-invalid @enderror" value="{{ old('pendapatan') }}">
                    @error('pendapatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="minggu">Minggu ke</label>
                    <select name="minggu" id="minggu" class="form-control @error('minggu') is-invalid @enderror" required>
                      <option value="0">Pilih Minggu ke</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                    @error('minggu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="submit" value="Submit" class="btn btn-success">
                <input type="reset" value="Reset" class="btn btn-danger">
            </form>
          </div>
        </div>
      </div>

</div>
@endsection