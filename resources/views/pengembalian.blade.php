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
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="pengembalian_id" id="pengembalian_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Kembali</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="kode_kembali" name="kode_kembali" placeholder="Enter Kode Kembali" value="" maxlength="50" required="">
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
                        ${value.nama}
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
                        ${value.nama}
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
                        ${value.judul}
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
          error: function (data) {
              console.log('Error:', data);
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