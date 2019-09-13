<!DOCTYPE html>
<html>
<head>
<title>Perpustakaan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="nav-link" href="{{ url('/petugas') }}">Petugas</a>
                    <a class="nav-link" href="{{ url('/anggota') }}">Anggota</a>
                    <a class="nav-link" href="{{ url('/buku') }}">Buku</a>
                    <a class="nav-link" href="{{ url('/rak') }}">Rak</a>
                    <a class="nav-link" href="{{ url('/peminjaman') }}">Peminjaman</a>
                    <a class="nav-link" href="{{ url('/pengembalian') }}">Pengembalian</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br>
    <center><h2>Perpustakaan</h2></center>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Tambah pengembalian</a><br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Jatuh Tempo</th>
                <th>Denda Perhari</th>
                <th>Jumlah Hari</th>
                <th>Total Denda</th>
                <th>Kode Petugas</th>
                <th>Kode Anggota</th>
                <th>KOde Buku</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div id="result">

                </div>
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="pengembalian_id" id="pengembalian_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Kembali</label>
                        <div class="col-sm-12">
                                <input type="text" class="form-control @error('kode_kembali') is-invalid @enderror" 
                                id="kode_kembali" name="kode_kembali" placeholder="Masukkan Kode Pengembalian
                                " value="" maxlength="50" required="">
                                @error('kode_kembali')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Kembali</label>
                        <div class="col-sm-12">
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" placeholder="Enter Tanggal Kembali" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jatuh Tempo</label>
                        <div class="col-sm-12">
                        <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" placeholder="Enter Jatuh Tempo" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Petugas</label>
                        <div class="col-sm-12">
                            <select id="kode_petugas" class="form-control js-example-basic-single isi-petugas" name="kode_petugas"></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Anggota</label>
                        <div class="col-sm-12">
                            <select id="kode_anggota" class="form-control js-example-basic-single isi-anggota" name="kode_anggota"></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Buku</label>
                        <div class="col-sm-12">
                            <select id="kode_buku" class="form-control js-example-basic-single isi-tag" name="kode_buku"></select>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
    
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengembalian.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_kembali', name: 'kode_kembali'},
            {data: 'tanggal_kembali', name: 'tanggal_kembali'},
            {data: 'jatuh_tempo', name: 'jatuh_tempo'},
            {data: 'denda_perhari', name: 'denda_perhari'},
            {data: 'jumlah_hari', name: 'jumlah_hari'},
            {data: 'total_denda', name: 'total_denda'},
            {data: 'kode_petugas', name: 'kode_petugas'},
            {data: 'kode_anggota', name: 'kode_anggota'},
            {data: 'kode_buku', name: 'kode_buku'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $.ajax({
        url: "{{ url('petugas') }}",
        method: "GET",
        dataType: "json",
        
        success: function (berhasil) {
            // console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $(".isi-petugas").append(
                    `
                    <option value="${value.id}">
                        ${value.kode_petugas}
                    </option>        
                    `
                )
            }) 
        }
    })

    $.ajax({
        url: "{{ url('anggota') }}",
        method: "GET",
        dataType: "json",
        
        success: function (berhasil) {
            // console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $(".isi-anggota").append(
                    `
                    <option value="${value.id}">
                        ${value.kode_anggota}
                    </option>        
                    `
                )
            }) 
        }
    })

    $.ajax({
        url: "{{ url('buku') }}",
        method: "GET",
        dataType: "json",
        
        success: function (berhasil) {
            // console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $(".isi-tag").append(
                    `
                    <option value="${value.id}">
                        ${value.kode_buku}
                    </option>        
                    `
                )
            }) 
        }
    })





     
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#pengembalian_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Anggota");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProduct', function () {
      var pengembalian_id= $(this).data('id');
      $.get("{{ route('pengembalian.index') }}" +'/' + pengembalian_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#pengembalian_id').val(data.id);
          $('#kode_kembali').val(data.kode_kembali);
          $('#tanggal_kembali').val(data.tanggal_kembali);
          $('#jatuh_tempo').val(data.jatuh_tempo);
          $('#denda_perhari').val(data.denda_perhari);
          $('#jumlah_hari').val(data.jumlah_hari);
          $('#total_denda').val(data.total_denda);
          $('#kode_petugas').val(data.kode_petugas);
          $('#kode_anggota').val(data.kode_anggota);
          $('#kode_buku').val(data.kode_buku);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('pengembalian.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (request,status,error) {
            $('#result').html('');
              json = $.parseJSON(request.responseText);
              $("#result").html('');
            //   $('#alert').css('display','block');
              $.each(json.errors, function(key, value){
                  console.log(value[0]);
                //   $("#result").append(value[0]);
                  
                  $('#result').append('<p>'+value[0]+'</p>');
              });
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteProduct', function () {
     
        var pengembalian_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('pengembalian.store') }}"+'/'+pengembalian_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</html>