<?php

namespace App\Http\Controllers;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index($idPengarang,Request $request){
        $table=new Pengarang();
        $pengarang=Pengarang::all();
        $buku=$table
        ->join('buku','buku.idPengarang','idPengarang')
        ->where('buku.idPengarang','idPengarang')
        ->select('buku.idBuku')->count();
        $target=$table->where('idPengarang',$idPengarang)->get();
        $request->session()->now('popup', true);
        return view('tables.pengarang',['target'=>$target],compact('target','buku','pengarang'));
    }
    public function add(Request $request){
        $table=new Pengarang();
        if(count($table->select('idPengarang')->get())==0){
            $idPengarang=000000;
        }
        else{
            $query=$table->select('idPengarang')->orderBy('idPengarang','DESC')->get();
            $idPengarang=($query->first()->idPengarang)+1;
        }
        $table->insert([
            'idPengarang'=>$idPengarang,
            'nPengarang'=>$request->nPengarang,
            'created_at'=>Carbon::now()
        ]);
        return redirect('/pengarang');
    }
    public function edit($idPengarang,Request $request){
        $table=new Pengarang();
        $table->where('idPengarang',$idPengarang)->update([
            'nPengarang'=>$request->nPengarang,
        ]);
        return redirect('/pengarang');
    }
    public function delete($idPengarang){
        $table=new Pengarang();
        $table->where('idPengarang',$idPengarang)->delete();
        return redirect('/pengarang');
    }
}
