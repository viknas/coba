@extends('layouts.template')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengingat</h1>
  <a href="{{ route('pengingat.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Lihat Data
  </a>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pengingat</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form action="{{ route('pengingat.update', $pengingat->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="barang">Nama Barang</label>
                    <input type="text" name="barang" id="barang" class="form-control @error('barang') is-invalid @enderror" value="{{ old('barang', $pengingat->barang) }}">
                    @error('barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $pengingat->harga) }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="awal">Awal Beli</label>
                    <input type="date" name="awal" id="awal" class="form-control @error('awal') is-invalid @enderror" value="{{ old('awal', date_format($pengingat->created_at, 'Y-m-d')) }}">
                    @error('awal')
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