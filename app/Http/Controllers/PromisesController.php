<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promise;
use App\Master;
use App\Detail;

class PromisesController extends Controller{
    public function index(){
        $all = Promise::where('keterangan','Publish')->count();
        $terpenuhi = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->count();
        $bukti = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
        $gagal = Promise::where('keterangan','Publish')->where('status','Gagal')->count();
        $proses = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->count();
        $verifikasi = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();
        
        $promises = Promise::where('keterangan','Publish')->paginate(6);

        return view('dashboard.index',compact('promises','terpenuhi','bukti','gagal','proses','verifikasi','all'));

    }

    public function getData(){
        $promises = Promise::get();
        $periode = Master::where('keterangan','periode')->get();
        $status = Master::where('keterangan','status')->get();
        $topik = Master::where('keterangan','topik')->get();

        return view('promise.list',compact('promises','periode','status','topik'));
    }

    public function create(){
        $periode = Master::where('keterangan','periode')->get();
        $status = Master::where('keterangan','status')->get();
        $topik = Master::where('keterangan','topik')->get();

        return view('promise.create',compact('periode','status','topik'));
    }

    public function store(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'judul'         =>'required',
            'topik'         =>'required',
            'status'        =>'required',
            'periode'       =>'required',
            'keterangan'    =>'required',
            'isi'           =>'required',
            'tags'          =>'required',
        ]);
        
        $slug = str_slug($request->judul, '-');
        if(Promise::where('slug', $slug)->first() != null)
        $slug = $slug.'-'.time();

        $promises = Promise::create([
            'judul'         =>$request->judul,
            'topik'         =>$request->topik,
            'status'        =>$request->status,
            'periode'       =>$request->periode,
            'keterangan'    =>$request->keterangan,
            'slug'          =>$slug,
            'tags'          =>ucwords(ucwords($request->tags,',')),
        ]);

        $detail = Detail::create([
            'promise_id'    =>$promises->id,
            'deskripsi'     =>$request->isi,
            'status'        =>$request->status,
            'keterangan'    =>$request->keterangan,
        ]);

        return back()->with('success','Data berhasil disimpan!');

    }

    public function show($slug){
        $promises = Promise::where('slug',$slug)->first();
        $detail = Detail::where('promise_id',$promises->id)->get();
        $status = Master::where('keterangan','status')->get();

        return view('promise.show',compact('promises','detail','status'));
    }

    public function saveDetail(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'promise_id'    =>'required',
            'deskripsi'     =>'required',
            'status'        =>'required',
            'keterangan'    =>'required',
        ]);
        
        $promise = Promise::find($request->promise_id);

        $promise->update([
            'status'        =>$request->status,
        ]);

        $detail = Detail::create([
            'promise_id'    =>$request->promise_id,
            'deskripsi'     =>$request->deskripsi,
            'status'        =>$request->status,
            'keterangan'    =>$request->keterangan,
        ]);

        return back()->with('success','Data berhasil disimpan!');

    }

    public function editDetail($id){
        $data = Detail::whereId($id)->first();
        
        echo json_encode($data);
    }

    public function edit($id){
        $data = Promise::whereId($id)->first();
        
        echo json_encode($data);
    }

    public function update(Request $request){
        $promise = Promise::find($request->id);

        $promise->update([
            'judul'         =>$request->judul,
            'topik'         =>$request->topik,
            'status'        =>$request->status,
            'periode'       =>$request->periode,
            'keterangan'    =>$request->keterangan,
            'tags'          =>ucwords(ucwords($request->tags,',')),
        ]);

        return back()->with('success','Data berhasil diubah!');
    }

    public function updateDetail(Request $request){
        // dd($request->all());
        $promise = Promise::find($request->promise_id);
        $detail = Detail::find($request->id);

        $promise->update([
            'status'        =>$request->status,
        ]);

        $detail->update([
            'deskripsi'     =>$request->deskripsi,
            'status'        =>$request->status,
            'keterangan'    =>$request->keterangan
        ]);

        return back()->with('success','Data berhasil diubah!');
    }

    public function deleteDetail($id){
        $detail = Detail::find($id);
        $detail->delete();
        return back()->with('success','Data berhasil dihapus!');
    }

    public function destroy($id){
        $detail = Detail::where('promise_id',$id);
        $detail->delete();
        $promise = Promise::find($id);
        $promise->delete();
        // Promise::Find($id)->delete($id);
        return response()->json([
            'successs' => 'Record Delete successsfully'
        ]);
    }
}
