<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;

class ArtikelController extends Controller{
    public function getData(){
        $artikels = Artikel::orderby('created_at')->get();

        return view('artikel.list',compact('artikels'));
    }

    public function create(){
        return view('artikel.create');
    }

    public function store(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'judul'         =>'required',
            'keterangan'    =>'required',
            'isi'           =>'required',
            'foto'           =>'required',
        ]);
        
        $slug = str_slug($request->judul, '-');
        if(Artikel::where('slug', $slug)->first() != null)
        $slug = $slug.'-'.time();

        $artikels = Artikel::create([
            'judul'         =>$request->judul,
            'foto'           =>$request->foto,
            'isi'           =>$request->isi,
            'keterangan'    =>$request->keterangan,
            'slug'          =>$slug,
        ]);

        return back()->with('success','Data berhasil disimpan!');
    }

    public function show($slug){
        $artikel = Artikel::whereSlug($slug)->first();

        return view('artikel.show',compact('artikel'));
    }

    public function edit($id){
        $artikel = Artikel::whereSlug($id)->first();

        return view('artikel.edit',compact('artikel'));
    }

    public function update(Request $request, $id){
        $artikel = Artikel::find($id);

        $artikel->update([
            'judul'         =>$request->judul,
            'foto'          =>$request->foto,
            'isi'           =>$request->isi,
            'keterangan'    =>$request->keterangan,
        ]);

        return redirect('/artikel/list')->with('success','Data berhasil diubah!');
    }

    public function destroy($id){
        $artikel = Artikel::find($id);
        $artikel->delete();
        return response()->json([
            'successs' => 'Record Delete successsfully'
        ]);
    }
}
