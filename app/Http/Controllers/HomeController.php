<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Pengarang;
use App\Models\Penerbit;
use App\Models\anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function buku()
    {
        $buku= Buku::all();
        $table=new Buku();
        $tablePengarang=new Pengarang();
        $tablePenerbit=new Penerbit();
        $nPengarang= $table
        ->join('pengarang','pengarang.idPengarang','buku.idPengarang')
        ->select('pengarang.nPengarang')
        ->get();
        $nPenerbit= $table
        ->join('penerbit','penerbit.idPenerbit','buku.idPenerbit')
        ->select('penerbit.nPenerbit')
        ->get();
        $penerbitA= $tablePenerbit
        ->select('nPenerbit','idPenerbit')
        ->get();
        $pengarangA= $tablePengarang
        ->select('nPengarang','idPengarang')
        ->get();
        return view('tables.buku',compact('buku','nPengarang','nPenerbit','pengarangA','penerbitA'));
    }
    public function pengarang()
    {
        $table=new Pengarang();
        $tableBuku= new Buku();
        $pengarang=Pengarang::all();
        $idPengarang=$table->select('idPengarang')->get();
        
        $buku[]=Buku::
        select(DB::raw('count(*) as count, idPengarang'))
        ->whereIn('idPengarang', function($id) use($idPengarang){
            $id->select('idPengarang')->from('pengarang');
        })
        ->groupBy('idPengarang')
        ->count();
        
        return view('tables.pengarang',compact('buku','pengarang','idPengarang'));
    }
    public function penerbit()
    {
        return view('tables.penerbit');
    }
    public function pinjam()
    {
        return view('tables.pinjam');
    }
    public function kembali()
    {
        return view('tables.kembali');
    }
    public function anggota()
    {
        $table=new Anggota();
        $anggota=Anggota::all();
        $sPinjam=$table
        ->join('pinjam','pinjam.idAnggota','idAnggota')
        ->select('pinjam.sPinjam');
        return view('tables.anggota',compact('sPinjam','anggota'));
    }
}
