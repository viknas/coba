@extends('layouts.template')
@push('css')
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pengingat</h1>
  <a href="{{ route('pengingat.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
  </a>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Pengingat</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body border">
            @forelse ($pengingat as $item)  
                <div class="row d-flex justify-content-center shadow-sm my-1">
                    <div class="col-lg-3 col-md-2 bg-gradient-success rounded-left text-white p-4 my-2">
                        <div class="col-12 text-center mt-2">
                            <h5>{{ strtoupper($item->barang )}}</h5>
                        </div>
                        <div class="col-12 text-center ">
                            <h5>Rp {{ number_format($item->harga , 2 , ',','.') }}</h5>
                        </div>

                    </div>
                    <div class="col-lg-8 col-md-8 bg-light rounded-right p-4 my-2">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div class="form-group text-left">
                                    <label for="">Awal Beli</label>
                                    <input type="text" class="form-control" value="{{ date_format($item->created_at, 'Y-m-d') }}" readonly>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="form-group text-left">
                                    <label for="">Deadline</label>
                                    @php
                                        $week = $item->deadline;
                                        $deadlineDate = date('Y-m-d', strtotime("+$week weeks", strtotime($item->created_at)));
                                    @endphp
                                    <input type="text" class="form-control" value="{{ $deadlineDate }}" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group text-center">
                                    <label>Aksi</label><br>
                                    <a href="{{route('pengingat.edit', $item->id)}}">
                                        <button type="submit" class="btn btn-sm btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>|
                                    <form action="{{route('pengingat.destroy', $item->id)}}" method="POST" class="d-inline">
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
                </div>
            @empty
                <p>Belum ada data.</p>
            @endforelse
          </div>
        </div>

</div>
@endsection

@push('js')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
  
</script>
@endpush