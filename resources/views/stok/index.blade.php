@extends('layouts.template')

@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools">
        <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create')}}">Tambah</a>
      </div>
    </div>
    <div class="card-body">
      @if (session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Filter: </label>
            <div class="col-3">
              <select name="user_id" id="user_id" class="form-control">
                <option value="">- Semua -</option>
                @foreach ($user as $item)
                  <option value="{{$item->user_id}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">User</small>
            </div>
          </div>
        </div>
      </div>
      <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
        <thead>
          <tr>
              <th>ID</th>
              <th class="text-center">Barang</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Jumlah</th>
              <th class="text-center">User</th>
              <th>Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@push('css') 
@endpush

@push('js')
  <script>
    $(document).ready(function() {
      var dataStok = $('#table_stok').DataTable({
          serverSide: true,     
          processing: true,
          ajax: {
              "url": "{{ url('stok/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function(d) {
                d.user_id = $('#user_id').val();
              }
          },
          columns: [
            {
              data: "DT_RowIndex",            
              className: "text-center",
              orderable: false,
              searchable: false    
            },
            {
              data: "barang.barang_nama",               
              className: "",
              orderable: true,    
              searchable: true    
            },
            {
              data: "stok_tanggal",               
              className: "",
              orderable: true,    
              searchable: true    
            },
            {
              data: "stok_jumlah",               
              className: "",
              orderable: true,    
              searchable: true    
            },
            {
              data: "user.nama",               
              className: "",
              orderable: true,    
              searchable: true    
            },
            {
              data: "aksi",               
              className: "text-center",
              orderable: false,    
              searchable: false    
            }
          ]
      }); 

      $('#user_id').on('change', function() {
        dataStok.ajax.reload();
      })
      
    });
  </script>
@endpush 
 