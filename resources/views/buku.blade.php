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
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Tambah Buku</a><br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
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
                   <input type="hidden" name="buku_id" id="buku_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Kode Buku</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Enter Kode Buku" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter Judul" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Penulis</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Enter Penulis" value="" maxlength="50" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Penerbit</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Enter Penerbit" value="" maxlength="50" required="">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tahun Terbit</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Enter Tahun Terbit" value="" maxlength="50" required="">

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
        ajax: "{{ route('buku.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_buku', name: 'kode_buku'},
            {data: 'judul', name: 'judul'},
            {data: 'penulis', name: 'penulis'},
            {data: 'penerbit', name: 'penerbit'},
            {data: 'tahun_terbit', name: 'tahun_terbit'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#buku_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New buku");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.editProduct', function () {
      var buku_id = $(this).data('id');
      $.get("{{ route('buku.index') }}" +'/' + buku_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#buku_id').val(data.id);
          $('#kode_buku').val(data.kode_buku);
          $('#judul').val(data.judul);
          $('#penulis').val(data.penulis);
          $('#penerbit').val(data.penerbit);
          $('#tahun_terbit').val(data.tahun_terbit);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('buku.store') }}",
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
     
        var buku_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('buku.store') }}"+'/'+buku_id,
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