@extends('layouts.app')

@section('content')
<nav class='navbar navbar-expand navbar-dark bg-dark toolbar'>
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav ml-auto mt-2 mt-lg-0'>
        <div class='button-group'>
            <button class='btn d-inline' data-toggle='modal' data-target='#add'><span class='fa fa-plus fa-md text-purple'></span></button>
        </div>
        </ul>
        </div>
        </nav>
        <section>
        <div id='table-layout'>
        <div class='header_wrap'>
            <div class='num_rows'>
                    <div class='form-group'>
                        <select class  ='form-control' name='state' id='maxRows'>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='20'>20</option>
                            <option value='50'>50</option>
                            <option value='70'>70</option>
                            <option value='100'>100</option>
                <option value='5000'>Show ALL Rows</option>
                            </select>
                        
                    </div>
            </div>
            <div class='tb_search'>
    <input type='text' id='search_input_all' onkeyup='FilterkeyWord_all_table()' placeholder='Search..' class='form-control'>
            </div>
        </div>
    <table class='table table-responsive table-hover bg-transculent-white borderless' id='table-id'>
        <thead>
        <tr>
                <th>ID</th>
                <th>Nama Anggota</th>
                <th>Sedang Meminjam Buku</th>
        </tr>
        </thead>
        <tbody>
            @foreach($anggota as $table)
            <tr>
                <td>{{$table->idAnggota}}</td>
                <td>{{$table->nAnggota}}</td>

                @if($table->sPinjam==1)
                <td><div class="badge bg-success text-light">Ya</div></td>
                @else
                <td><div class="badge bg-danger text-light">Tidak</div></td>
                @endif
            <td>
                <div class='btn-group'>
                <a href={{url("anggota/e/$table->idAnggota")}}><button type='submit' class='btn btn-sm' data-toggle='modal'><span class='fa fa-edit fa-sm text-success delete-row'></span></button></a>
                <button class='btn btn-sm' data-toggle='modal' data-target='#delete' data-href='{{url("anggota/d/$table->idAnggota")}}'><span class='fa fa-trash fa-sm text-danger delete-row'></span></button>
                </div>
            </td>
            @endforeach
        </tr>
        </tbody>
        </table>
            <div class='pagination-container'>
                <nav aria-label='Page navigation'>
                    <ul class='pagination'>
                    </ul>
                </nav>
            </div>
        <div class='rows_count'>Showing 11 to 20 of 91 entries</div>
        </div></section>
        
@endsection

@section('edit')
@isset($target)
@foreach($target as $anggota)
            <form action='{{url("anggota/e/$anggota->idAnggota")}}' method='post' class='row needs-validation form' novalidate>
            @csrf
                    <div class='modal fade' id='edit' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    Edit anggota
                                </div>
                                <div class='modal-body'>
                                <div class='container'>
                                    <div class='row'>
                                        <div class='col col-md'>
                                                <label for='nAnggota' class='form-label'><b>Nama anggota</b></label>
                                                <input type='text' value='{{$anggota->nAnggota}}' autocomplete='off' class='form-control' id='nAnggota' name='nAnggota' required>
                                        </div> 
                                    </div>
                                </div>
                                </div>
                                <div class='modal-footer'>
                                    <span type='button' class='btn btn-default' data-dismiss='modal'>Cancel</span>
                                    <button class='btn btn-danger text-light' type='submit'>Submit</button>
                                </div>                    
                            </div>
                        </div>
                    </div>
            </form>
@endforeach
@endisset
@endsection

@section('add')
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Tambahkan Anggota
            </div>
            <form action='{{url("anggota/a/")}}' method='post' class='row needs-validation form' novalidate>
            @csrf
            <div class="modal-body">
            <div class="container">
                            <div class='row'>
                            <div class='col col-md'>
                                    <label for='nAnggota' class='form-label'><b>Nama Anggota</b></label>
                                    <input type='text' autocomplete='off' class='form-control' id='nAnggota' name='nAnggota' required>
                            </div> 
                            </div>
                            <!-- ";
                        case "pengarang":
                            echo "
                            <div class='row'>
                            <div class='col col-md'>
                                    <label for='nama-pengarang' class='form-label'><b>Nama Pengarang</b></label>
                                    <input type='text' autocomplete='off' class='form-control' id='nama-pengarang' name='nPengarang' required>
                                    <div class='invalid-feedback'>
                                    Mohon untuk mengisi Nama Pengarang
                                    </div> 
                            </div> 
                            </div>
                            ";
                            break;
                            case "penerbit":
                            echo "
                            <div class='row'>
                            <div class='col col-md'>
                                    <label for='nama-penerbit' class='form-label'><b>Nama Penerbit</b></label>
                                    <input type='text' autocomplete='off' class='form-control' id='nama-penerbit' name='nPenerbit' required>
                                    <div class='invalid-feedback'>
                                    Mohon untuk mengisi Nama Penerbit
                                    </div> 
                            </div> 
                            </div>
                            ";
                            break;
                        case "pinjam": 
                            echo "
                            <div class='row'>
                            <div class='col col-md'>
                                    <label for='id-anggota' class='form-label'><b>ID Anggota</b></label>
                                    <input type='text' autocomplete='off' class='form-control' id='id-anggota' name='idAnggota' required>
                                    <div class='invalid-feedback'>
                                    Mohon untuk mengisi ID Anggota
                                    </div> 
                            </div> 
                            </div>
                            <div class='row'>
                            <div class='col col-md'>
                            <label for='judul-buku' class='form-label'><b>Buku</b></label>
                                <input type='text' name='buku' id='judul-buku' autocomplete='off' class='form-control' list='list-buku' placeholder='Cari Judul Buku, ID, atau Pengarang'>
                                <datalist id='list-buku'>";
                                $listBuku=mysqli_query($conn,'SELECT nBuku,idBuku,idPengarang from buku order by idBuku');
                                while($fetch=mysqli_fetch_array($listBuku)){
                                    while($fetchB=mysqli_fetch_array(mysqli_query($conn,"SELECT nPengarang from pengarang where idPengarang=$fetch[idPengarang]"))){
                                        echo "<option value='$fetch[idBuku]'>$fetch[nBuku] - $fetchB[nPengarang]</option>";
                                        break;
                                    }
                                    
                                }
                                echo "</datalist>
                            </div>
                            </div>
                            ";
                            break;
                        case "kembali": 
                            echo "
                            <div class='row'>
                            <div class='col col-md'>
                                    <label for='id-buku' class='form-label'><b>ID Buku</b></label>
                                    <input type='text' autocomplete='off' class='form-control' id='id-buku' name='idBuku' required>
                                    <div class='invalid-feedback'>
                                    Mohon untuk mengisi ID Buku
                                    </div> 
                            </div> 
                            </div>
                            ";
                            break;
                        default:
                            echo "not epic";
                            break;
                        
                    }
                ?> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type='submit' class="btn btn-danger btn-ok">Tambahkan</button>
            </div>
            </form> 
        </div>
    </div>
</div>
@endsection