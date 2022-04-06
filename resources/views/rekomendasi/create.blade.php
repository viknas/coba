@extends('layouts.template')
@section('content')

<div class="card-body">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Rekomendasi Menu</h1>
    <a href="{{ route('rekomendasi.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Lihat Menu
    </a>
</div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Rekomendasi Menu</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <form action="{{ route('rekomendasi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul_menu">Judul Menu</label>
                    <input type="text" name="judul_menu" id="judul_menu" class="form-control @error('judul_menu') is-invalid @enderror" value="{{ old('judul_menu') }}">
                    @error('judul_menu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bahan">Bahan-bahan</label>
                    <textarea name="bahan" id="bahan" cols="30" rows="5" class="form-control @error('bahan') is-invalid @enderror">
                        {{ old('bahan') }}
                    </textarea>
                    @error('bahan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="langkah">Langkah-langkah</label>
                    <textarea name="langkah" id="langkah" cols="30" rows="5" class="form-control @error('langkah') is-invalid @enderror">
                        {{ old('langkah') }}
                    </textarea>
                    @error('langkah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                    @error('foto')
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