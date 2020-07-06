<html>
<head>
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function batalkan() {
            swal({
                title: 'Peringatan!',
                text: 'Apakah proses tambah pengguna ingin dibatalkan?',
                icon: 'warning',
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('frm-tambah-user').reset();
                    window.location.href = '{{ url('/') }}'
                }
            });
        }
        {{--$(document).ready(function () {--}}
        {{--    $('#frm-tambah-user').on('submit', function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        var data = $(this).serializeArray();--}}
        {{--        $.ajax({--}}
        {{--            url: '{{ url('api/pengguna/insert') }}',--}}
        {{--            type: 'post',--}}
        {{--            data: data,--}}
        {{--            dataType: 'json',--}}
        {{--            success: function (respon) {--}}
        {{--                if (respon.status === 1) {--}}
        {{--                    swal('Data berhasil ditambah');--}}
        {{--                    window.location.href = '{{ url('pengguna') }}'--}}
        {{--                } else {--}}
        {{--                    swal(respon.msg)--}}
        {{--                }--}}
        {{--            }--}}
        {{--        })--}}
        {{--    })--}}
        {{--});--}}
    </script>
</head>
<body>
<div class="container">
    <h3>Tambah Pengguna</h3>
    <form action="{{ url('pengguna/insert') }}" method="post" name="frm-tambah-user" id="frm-tambah-user" autocomplete="off">
        @csrf
        <div class="form-group row">
            <label class="col-md-3">ID User</label>
            <div class="col-md-4">
                <input type="text" autocomplete="off" name="user_login" id="user_login" class="form-control" maxlength="30">
                @error('user_login')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3">Email</label>
            <div class="col-md-4">
                <input type="email" name="user_email" id="user_email" disabled class="form-control" maxlength="50">
                @error('user_email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3">Password</label>
            <div class="col-md-4">
                <input type="password" name="user_password" id="user_password" class="form-control" maxlength="100" autocomplete="new-password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3">Deskripsi</label>
            <div class="col-md-4">
                <input type="text" name="user_deskripsi" id="user_deskripsi" class="form-control" maxlength="150">
            </div>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
            <button type="button" class="btn btn-sm btn-default" onclick="batalkan()">Batalkan</button>
        </div>
    </form>
</div>
</body>
</html>
