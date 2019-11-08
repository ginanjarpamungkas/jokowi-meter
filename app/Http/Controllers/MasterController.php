<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master;

class MasterController extends Controller{
    public function periode(){
        $periode = Master::where('keterangan','periode')->get();
        return view('master.periode',compact('periode'));
    }

    public function status(){
        $Status = Master::where('keterangan','status')->get();
        return view('master.status',compact('Status'));
    }

    public function topik(){
        $Topik = Master::where('keterangan','topik')->get();
        return view('master.topik',compact('Topik'));
    }

    public function periodeStore(Request $request) {
        $nama = $request->name;
        $save = Master::create([
            'nama'          =>  $nama,
            'keterangan'    =>  'periode'
        ]);

        return ['namaB' => $save->nama, 'idB' => $save->id];
    }

    public function deletePeriode($id){
        Master::Find($id)->delete($id);
        return response()->json([
            'success' => 'Record Delete successsfully'
        ]);
    }

    public function statusStore(Request $request) {
        $nama = $request->name;
        $save = Master::create([
            'nama'          =>  $nama,
            'keterangan'    =>  'status'
        ]);

        return ['namaB' => $save->nama, 'idB' => $save->id];
    }

    public function deleteStatus($id){
        Master::Find($id)->delete($id);
        return response()->json([
            'success' => 'Record Delete successsfully'
        ]);
    }

    public function topikStore(Request $request) {
        $nama = $request->name;
        $save = Master::create([
            'nama'          =>  $nama,
            'keterangan'    =>  'topik'
        ]);

        return ['namaB' => $save->nama, 'idB' => $save->id];
    }

    public function deleteTopik($id){
        Master::Find($id)->delete($id);
        return response()->json([
            'success' => 'Record Delete successsfully'
        ]);
    }
}
