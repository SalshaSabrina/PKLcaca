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
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Tambah Petugas</a><br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Petugas</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div id="result">

                </div>
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="petugas_id" id="petugas_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Petugas</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control @error('kode_petugas') is-invalid @enderror" 
                        id="kode_petugas" name="kode_petugas" placeholder="Masukkan Kode Petugas
                        " value="" maxlength="50" required="">
                        @error('kode_petugas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                        <div class="col-sm-12">
                        <input type="radio" id="jk" name="jk" value="Laki-laki" /> Laki-laki
                        <input type="radio" id="jk" name="jk" value="Perempuan" /> Perempuan
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jabatan</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Enter Jabatan" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telp</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="telp" name="telp" placeholder="Enter Telp" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat" value="" maxlength="50" required="">
                        </textarea>
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
    
<script>
        $("#productForm").validate({
            rules: {
                kode_petugas: {
                    required:true,
                    maxlength : 4
                },
                nama: {
                    required:true
                },
                jk:{
                    required:true
                },
                jabatan: {
                    required:true
                },
                telp:{
                    required:true
                },
                alamat: {
                    required:true
                }
            },
            messages:{
                kode_petugas:{
                    required:"Harap diisi",
                    maxlength:"Tidak bisa lebih dari 4"
                },
                nama:{
                    required:"Harap diisi"
                },
                jk:{
                    required:"Harap diisi"
                },
                jabatan:{
                    required:"Harap diisi"
                },
                telp:{
                    required:"Harap diisi"
                },
                alamat:{
                    required:"Harap diisi"
                }
            }
        })
    </script>


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
        ajax: "{{ route('petugas.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_petugas', name: 'kode_petugas'},
            {data: 'nama', name: 'nama'},
            {data: 'jk', name: 'jk'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'telp', name: 'telp'},
            {data: 'alamat', name: 'alamat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#petugas_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Petugas");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProduct', function () {
      var petugas_id = $(this).data('id');
      $.get("{{ route('petugas.index') }}" +'/' + petugas_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#petugas_id').val(data.id);
          $('#kode_petugas').val(data.kode_petugas);
          $('#nama').val(data.nama);
          $('#jk').val(data.jk);
          $('#jabatan').val(data.jabatan);
          $('#telp').val(data.telp);
          $('#alamat').val(data.alamat);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('petugas.store') }}",
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
     
        var petugas_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('petugas.store') }}"+'/'+petugas_id,
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