<html>
<head>
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var tbl;
        $(document).ready(function() {
            tbl = $('#example').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: '<?php echo url('api/pengguna/get') ?>',
                columns: [
                    {'data': 'login'},
                    {'data': 'pswd'},
                    {'data': 'email'},
                    {'data': 'deskripsi'},
                    {'data': function (data) {
                        var btn = '<a href="<?php echo url('/pengguna/ubah') ?>/'+btoa(data.email+'&'+data.login)+'" class="btn btn-warning" title="ubah data"><span class="fa fa-pencil"></span></a>';
                        btn += '<a class="btn btn-danger" title="hapus data" onclick="hapusUser(\''+btoa(data.email+'&'+data.login)+'\')"><span class="fa fa-trash"></span></a>';
                        return btn;
                    }}
                ]
            });
        } );
        function hapusUser(id) {
            var decyper = atob(id).split('&');
            var login = decyper[1]

            swal({
                title: 'Peringatan!',
                text: 'Apakah ID User '+login+' ingin dihapus?',
                icon: 'warning',
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{{ url('api/pengguna/delete') }}/' + id,
                        success: function (response) {
                            swal(response.msg);
                            tbl.ajax.reload();
                        }
                    })
                }
            });
        }
    </script>
</head>
<body>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>ID User</th>
        <th>Password</th>
        <th>Email</th>
        <th>Deskripsi</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    <tr>
        <th>ID User</th>
        <th>Password</th>
        <th>Email</th>
        <th>Deskripsi</th>
        <th></th>
    </tr>
    </tfoot>
</table>
<div class="col-md-12">
    <a href="{{ url('pengguna/tambah') }}" class="btn btn-sm btn-primary">
        <span class="fa fa-plus"><i> Tambah Data</i></span>
    </a>
    <a href="{{ url('login') }}" class="btn btn-sm btn-primary">
        <span class="fa fa-user"><i> Login</i></span>
    </a>
</div>
</body>
</html>
