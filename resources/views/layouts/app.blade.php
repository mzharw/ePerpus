<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts')
    @stack('styles')
    <style>
        img#logo{
        width: 45px;
    }
    </style>
    <title>Aplikasi Perpustakaan</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

    <div class="bg-dark text-light" id="sidebar-wrapper">
    <div class="sidebar-heading"><h5>Selamat datang</h5><p>
    @if (Route::has('login'))
        {{session()->get('username')}}
    @endif
    </p></div>
    <div class="list-group list-group-flush">
        <a href="{{url('dashboard')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-tachometer"></span>&nbsp;Dashboard</a>
        <a href="{{url('buku')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-book"></span>&nbsp;Buku</a>
        <a href="{{url('anggota')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-user"></span>&nbsp;Anggota</a>
        <a href="{{url('pengarang')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-pen"></span>&nbsp;Pengarang</a>
        <a href="{{url('penerbit')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-building-o"></span>&nbsp;Penerbit</a>
        <a href="{{url('pinjam')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-arrow-alt-circle-left"></span>&nbsp;Pinjam</a>
        <a href="{{url('kembali')}}" class="list-group-item list-group-item-action bg-dark text-light"><span class="fa fa-fw fa-arrow-alt-circle-right"></span>&nbsp;Kembali</a>
    </div>
    </div>

    <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg">
        <span class="btn" id="menu-toggle"><i class="fas fa-arrow-left" id="button-arrow"></i></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <strong class='text-uppercase d-inline-block'>
            </strong>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                <a href="#" class="nav-link text-light" data-href="{{url('logout')}}" data-toggle="modal" data-target="#logout"><span class="fa fa-fw fa-sign-out"></span>&nbsp;Logout</a>

                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="container-fluid content">
            @yield('content')
        </div>
    </div>
</div>

</div>
<!-- modal -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Logout
            </div>
            <div class="modal-body">
                Konfirmasi akan logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Logout</a>
            </div>
        </div>
    </div>
</div>
@yield('edit')
    <div class='modal fade' id='delete' tabindex='-1' role='dialog' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            Hapus
                        </div>
                        <div class='modal-body'>
                        Apakah anda yakin ingin menghapus?
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                            <a class='btn btn-danger btn-ok text-light'>Delete</a>
                        </div>
                    </div>
                </div>
    </div>
@yield('add')
<!-- Script -->
@stack('scripts')
    @if(session('popup'))
    <script>$('#edit').modal('show');</script>
    @endif
</body>
</html>
