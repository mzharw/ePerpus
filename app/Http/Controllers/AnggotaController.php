<?php

namespace App\Http\Controllers;
use App\Models\Anggota;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index($idAnggota,Request $request){
        $table=new Anggota();
        $anggota=Anggota::all();
        $sPinjam=$table
        ->join('pinjam','pinjam.idAnggota','idAnggota')
        ->select('pinjam.sPinjam');
        $target=$table->where('idAnggota',$idAnggota)->get();
        $request->session()->now('popup', true);
        return view('tables.anggota',['target'=>$target],compact('target','sPinjam','anggota'));
    }
    public function add(Request $request){
        $table=new Anggota();
        if(count($table->select('idAnggota')->get())==0){
            $idAnggota=000000;
        }
        else{
            $query=$table->select('idAnggota')->orderBy('idAnggota','DESC')->get();
            $idAnggota=($query->first()->idAnggota)+1;
        }
        $table->insert([
            'idAnggota'=>$idAnggota,
            'nAnggota'=>$request->nAnggota,
            'created_at'=>Carbon::now()
        ]);
        return redirect('/anggota');
    }
    public function edit($idAnggota,Request $request){
        $table=new Anggota();
        $table->where('idAnggota',$idAnggota)->update([
            'nAnggota'=>$request->nAnggota,
        ]);
        return redirect('/anggota');
    }
    public function delete($idAnggota){
        $table=new Anggota();
        $table->where('idAnggota',$idAnggota)->delete();
        return redirect('/anggota');
    }
}
