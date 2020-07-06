<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="container">
    <form name="frm-login" id="frm-login" method="post" action="{{ url('login') }}">
        @csrf
        <div class="form-group row">
            <label class="col-md-3">User ID</label>
            <div class="col-md-4">
                <input type="text" name="user_login" id="user_login" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3">Password</label>
            <div class="col-md-4">
                <input type="password" name="user_password" id="user_password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
</body>
</html>
