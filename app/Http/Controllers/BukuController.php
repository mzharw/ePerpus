<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Pengarang;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Session\TokenMismatchException;

class BukuController extends Controller
{
    public function index($idBuku,Request $request){
        $table=new Buku();
        $tablePengarang=new Pengarang();
        $tablePenerbit=new Penerbit();
        $target=$table->where('idBuku',$idBuku)->get();
        $buku= Buku::all();
        $penerbitA= $tablePenerbit
        ->select('nPenerbit','idPenerbit')
        ->get();
        $pengarangA= $tablePengarang
        ->select('nPengarang','idPengarang')
        ->get();
        $nPengarang=$table
        ->join('pengarang','pengarang.idPengarang','buku.idPengarang')
        ->select('pengarang.nPengarang')
        ->where('buku.idBuku','!=',$idBuku)
        ->get();

        $pengarangS= $table
        ->join('pengarang','pengarang.idPengarang','buku.idPengarang')
        ->select('pengarang.nPengarang','pengarang.idPengarang')
        ->where('buku.idBuku',$idBuku)
        ->get();
        
        $pengarangL= $table
        ->join('pengarang','pengarang.idPengarang','buku.idPengarang')
        ->select('pengarang.nPengarang','pengarang.idPengarang')
        ->whereNotIn('pengarang.idPengarang',function ($query) use ($idBuku){
            $query->select('idPengarang')
            ->from('buku')
            ->where('buku.idBuku','!=',$idBuku);
        })
        ->get();

        $nPenerbit= $table
        ->join('penerbit','penerbit.idPenerbit','buku.idPenerbit')
        ->select('penerbit.nPenerbit')
        ->get();

        $penerbitS= $table
        ->join('penerbit','penerbit.idPenerbit','buku.idPenerbit')
        ->select('penerbit.nPenerbit','penerbit.idPenerbit')
        ->where('buku.idBuku',$idBuku)
        ->get();
        
        $penerbitL= $table
        ->join('penerbit','penerbit.idPenerbit','buku.idPenerbit')
        ->select('penerbit.nPenerbit','penerbit.idPenerbit')
        ->whereNotIn('penerbit.idPenerbit',function ($query) use ($idBuku){
            $query->select('idPenerbit')
            ->from('buku')
            ->where('buku.idBuku','!=',$idBuku);
        })
        ->get();
        $request->session()->now('popup', true);
        return view('tables.buku',['target'=>$target],compact('buku','target','nPengarang', 'pengarangS','pengarangL','nPenerbit','penerbitS','penerbitL','pengarangA','penerbitA'));
    }
    public function edit($idBuku, Request $request){
        $table=new Buku();
        $table->where('idBuku',$idBuku)->update([
            'nBuku'=>$request->nBuku,
            'idPengarang'=>$request->idPengarang,
            'idPenerbit'=>$request->idPenerbit
        ]);
        return redirect('/buku');
    }
    public function delete($idBuku){
        $table=new Buku();
        $table->where('idBuku',$idBuku)->delete();
        return redirect('/buku');
    }
    public function add(Request $request){
        $table=new Buku();
        if(count($table->select('idBuku')->get())==0){
            $idBuku=000000;
        }
        else{
            $query=$table->select('idBuku')->orderBy('idBuku','DESC')->get();
            $idBuku=($query->first()->idBuku)+1;
        }
        $table->insert([
            'idBuku'=>$idBuku,
            'nBuku'=>$request->nBuku,
            'idPengarang'=>$request->idPengarang,
            'idPenerbit'=>$request->idPenerbit,
            'created_at'=>Carbon::now()
        ]);
        return redirect('/buku');
    }

    public function render($request, Exception $e)
    {
        if ($e instanceof TokenMismatchException) { 
            return redirect('/');
        }
    }
}
