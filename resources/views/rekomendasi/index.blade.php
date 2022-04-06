@extends('layouts.template')
@push('css')
<link href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
@endpush
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekomendasi Masakan</h1>
  </div>
<!-- Page Body-->
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                List Daftar Rekomendasi
                <a href="{{ route('rekomendasi.create') }}" class="ml-4 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                </a>
            </div>
        </div>
    </div>
</div>
@foreach ($rekomendasi as $item)
<div class="container m-4">
    <div class="row border border-success rounded bg-success">
        
        <div class="col">
        </div>
        <div class="col-5 align-self-center text-start">
            <h4 class="text-light"> {{ $item->judul_menu }} </h4>
        </div>
        <div class="col-4  align-self-center">
            <img src="{{ asset($item->gambar) }}" alt="{{ $item->Judul_menu }}" class="rounded img-fluid" width="200px" height="100px">
        </div>
        <div class="col-2 align-self-center">
            <div class="form-group align-self-center text-center text-light">
                <label>Aksi</label><br>
                <a href="{{route('rekomendasi.edit', $item->id)}}">
                    <button type="submit" class="btn btn-sm btn-info btn-circle">
                        <i class="fas fa-pen"></i>
                    </button>
                </a>|
                <form action="{{route('rekomendasi.destroy', $item->id)}}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger btn-circle" onclick="return confirm('Hapus Data ?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('js')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
  
</script>
@endpush
