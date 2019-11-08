<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use App\Promise;
use App\Artikel;
use App\Master;
use DB;

class FrontController extends Controller{
    public function getData(){
        $all = Promise::where('keterangan','Publish')->count();
        $terpenuhi = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->count();
        $bukti = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
        $gagal = Promise::where('keterangan','Publish')->where('status','Gagal')->count();
        $proses = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->count();
        $verifikasi = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        $periode = Master::where('keterangan','periode')->get();
        $topik = Master::where('keterangan','topik')->get();

        $promises = Promise::where('keterangan','Publish')->orderBy('updated_at','desc')->paginate(8);

        return view('frontend.index',compact('terpenuhi','bukti','gagal','proses','promises','all','periode','topik','verifikasi'));

    }

    public function detail($slug){
        $promises = Promise::where('slug',$slug)->where('keterangan','Publish')->first();

        $terpenuhi = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->orderBy('updated_at','desc')->first();
        $bukti = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->orderBy('updated_at','desc')->first();
        $gagal = Promise::where('keterangan','Publish')->where('status','Gagal')->orderBy('updated_at','desc')->first();
        $proses = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->orderBy('updated_at','desc')->first();
        $verifikasi = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->orderBy('updated_at','desc')->first();
        
        if (empty($promises)){
            return view('error');
        }else{
            return view('frontend.detail',compact('promises','detail','terpenuhi','bukti','gagal','proses','verifikasi'));
        }
    }

    public function getDatas(Request $request){
        if($request->ajax()){
            if($request->id != null){
                $data = Promise::where('keterangan','Publish')->where('updated_at', '<', $request->id)->orderBy('updated_at','desc')->limit(8)->get();
            }else{
                $data = Promise::where('keterangan','Publish')->orderBy('updated_at','desc')->limit(8)->get();
            }
        $output = '';
        $last_id = '';
        $warna = '';
        
        if(!$data->isEmpty()){
            $output .= '<ul class="box-color">';
            foreach($data as $row){
                if($row->status == "Terpenuhi"){
                    $warna = 'bg-deepblue';
                }elseif ($row->status == "Dalam Proses"){
                    $warna = 'bg-blue';
                }elseif ($row->status == "Tidak Ada Bukti"){
                    $warna = 'bg-yellow';
                }elseif ($row->status == "Gagal"){
                    $warna = 'bg-orange';
                }else{
                    $warna = 'bg-grey';
                }
                $output .= '
                    <li>
                    <a href="'.url('/detail').'/'.$row->slug.'" class="fade">
                        <div class="debox '.$warna.'">
                            <h3 class="title">'.$row->status.'</h3>
                            <h5>'.strtoupper($row->topik).'</h5>
                            <h3>'.$row->judul.'</h3>
                        </div>
                    </a>
                    </li>
                ';
                $last_id = $row->updated_at;
            }
            $output .= '</ul>
            <div id="load" class="centering margin-top margin-bottom-lg">
				<button type="button" name="load_more_button" class="btn-load cl-black bg-white fade" data-id="'.$last_id.'" id="load_more_button">Muat lagi...</a>
			</div>
            ';
        }else{
            $output .= '
            <div class="centering margin-top margin-bottom-lg">
				<button type="button" name="load_more_button" class="btn-load cl-black bg-white fade">No Data Found</a>
			</div>
            ';
        }
        echo $output;
        }
    }

    public function getStatus($slug){
        $periode = Master::where('keterangan','periode')->get();
        $topik = Master::where('keterangan','topik')->get();

        switch ($slug) {
            case 'terpenuhi':
                $status = 'Terpenuhi';
                $all = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->count();
                $terpenuhi = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->count();
                $bukti = 0;
                $gagal = 0;
                $proses = 0;
                $verifikasi = 0;

                $warna = '#0F9D58';
                break;
            case 'dalam-proses':
                $status = 'Dalam Proses';
                $all = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->count();
                $terpenuhi = 0;
                $bukti = 0;
                $gagal = 0;
                $proses = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->count();
                $verifikasi = 0;

                $warna = '#F4B400';
                break;
            case 'tidak-ada-bukti':
                $status = 'Tidak Ada Bukti';
                $all = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
                $terpenuhi = 0;
                $bukti = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
                $gagal = 0;
                $proses = 0;
                $verifikasi = 0;

                $warna = '#017BC4';
                break;
            case 'tidak-terverifikasi':
                $status = 'Tidak Terverifikasi';
                $all = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();
                $terpenuhi = 0;
                $bukti = 0;
                $gagal = 0;
                $proses = 0;
                $verifikasi = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

                $warna = '#67615c';
                break;
            default:
                $status = 'Gagal';
                $all = Promise::where('keterangan','Publish')->where('status','Gagal')->count();
                $terpenuhi = 0;
                $bukti = 0;
                $gagal = Promise::where('keterangan','Publish')->where('status','Gagal')->count();
                $proses = 0;
                $verifikasi = 0;

                $warna = '#DB4437';
                break;
        }

        $promises = Promise::where('status',$status)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

        return view('frontend.status',compact('terpenuhi','bukti','gagal','proses','verifikasi','promises','all','periode','topik','status','warna'));

    }

    public function getSearch(Request $request){
        $keyword = $request->key;
        if (empty($keyword)) {
            return $this->getData();
        }
        $all = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
               ->where('keterangan','Publish')->count();
        
        $terpenuhi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
                     ->where('keterangan','Publish')->whereStatus('Terpenuhi')->count();
                            
        $bukti = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
                 ->where('keterangan','Publish')->whereStatus('Tidak Ada Bukti')->count();

        $gagal = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
                 ->where('keterangan','Publish')->whereStatus('Gagal')->count();

        $proses = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
               ->where('keterangan','Publish')->whereStatus('Dalam Proses')->count();
        
        $verifikasi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
               ->where('keterangan','Publish')->whereStatus('Tidak Terverifikasi')->count();

        $periode = Master::where('keterangan','periode')->get();
        $topik = Master::where('keterangan','topik')->get();
        
        $data = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$keyword.'%" OR d.deskripsi LIKE "%'.$keyword.'%" OR p.tags LIKE "%'.$keyword.'%") AS Data'))
                ->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

        return view('frontend.search',compact('data','terpenuhi','bukti','gagal','proses','all','periode','topik','verifikasi'));
    }

    public function getFilter(Request $request){
        if($request->ajax()){
        $getperiode = $request->periode;
        $gettopik = $request->topik;
        $getstatus = $request->status;
        $getkey = $request->key;
        $all = '';

        if ($getperiode == null AND $gettopik == null AND $getstatus == null AND $getkey == null) {
            $data = Promise::where('keterangan','Publish')->orderBy('updated_at','desc')->limit(8)->get();

            $jumlah_janji = Promise::where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();
            
            $all = 'ada';
        } elseif ($gettopik == null AND $getstatus == null AND $getkey == null) {

            $data = Promise::where('periode',$getperiode)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('periode',$getperiode)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('periode',$getperiode)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('periode',$getperiode)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('periode',$getperiode)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getperiode == null AND $getstatus == null AND $getkey == null) {
            $data = Promise::where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('topik',$gettopik)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('topik',$gettopik)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('topik',$gettopik)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('topik',$gettopik)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getstatus == null AND $getkey == null) {
            $data = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getstatus != null AND $getperiode != null AND $gettopik != null AND $getkey == null) {
            $data = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getstatus != null AND $getperiode == null AND $gettopik == null AND $getkey == null) {
            $data = Promise::where('status',$getstatus)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('status',$getstatus)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('status',$getstatus)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('status',$getstatus)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('status',$getstatus)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('status',$getstatus)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('status',$getstatus)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($gettopik == null AND $getstatus != null AND $getkey == null) {
            $data = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('status',$getstatus)->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getperiode == null AND $getstatus != null AND $getkey == null) {
            $data = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->count();
            $terpenuhi = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Terpenuhi')->count();
            $bukti = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->count();
            $gagal = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Gagal')->count();
            $proses = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Dalam Proses')->count();
            $verifikasi = Promise::where('status',$getstatus)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->count();

        } elseif ($getkey != null AND $gettopik == null AND $getperiode == null) {
            $data = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->orderBy('updated_at','desc')->count();
            $terpenuhi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->where('status','Terpenuhi')->orderBy('updated_at','desc')->count();
            $bukti = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->orderBy('updated_at','desc')->count();
            $gagal = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->where('status','Gagal')->orderBy('updated_at','desc')->count();
            $proses = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->where('status','Dalam Proses')->orderBy('updated_at','desc')->count();
            $verifikasi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->orderBy('updated_at','desc')->count();

        } elseif ($getkey != null AND $getperiode == null) {
            $data = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->count();
            $terpenuhi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Terpenuhi')->orderBy('updated_at','desc')->count();
            $bukti = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->orderBy('updated_at','desc')->count();
            $gagal = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Gagal')->orderBy('updated_at','desc')->count();
            $proses = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Dalam Proses')->orderBy('updated_at','desc')->count();
            $verifikasi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->orderBy('updated_at','desc')->count();

        } elseif ($getkey != null AND $gettopik == null) {
            $data = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();

            $jumlah_janji = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->orderBy('updated_at','desc')->count();
            $terpenuhi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Terpenuhi')->orderBy('updated_at','desc')->count();
            $bukti = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->orderBy('updated_at','desc')->count();
            $gagal = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Gagal')->orderBy('updated_at','desc')->count();
            $proses = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Dalam Proses')->orderBy('updated_at','desc')->count();
            $verifikasi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->orderBy('updated_at','desc')->count();

        } elseif ($getkey != null AND $getperiode != null AND $gettopik != null) {
            $data = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->get();
            $jumlah_janji = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->orderBy('updated_at','desc')->count();
            $terpenuhi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Terpenuhi')->orderBy('updated_at','desc')->count();
            $bukti = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Ada Bukti')->orderBy('updated_at','desc')->count();
            $gagal = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Gagal')->orderBy('updated_at','desc')->count();
            $proses = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Dalam Proses')->orderBy('updated_at','desc')->count();
            $verifikasi = Promise::from(DB::raw('(SELECT p.* FROM `promises` p JOIN `detail_promises` d ON p.id = d.promise_id WHERE p.judul LIKE "%'.$getkey.'%" OR d.deskripsi LIKE "%'.$getkey.'%" OR p.tags LIKE "%'.$getkey.'%") AS Data'))->where('periode',$getperiode)->where('topik',$gettopik)->where('keterangan','Publish')->where('status','Tidak Terverifikasi')->orderBy('updated_at','desc')->count();
        }
        $last_id = '';
        $output = '';
        $warna = '';
        
        if(!$data->isEmpty()){
            $output .= '<ul class="box-color">';
            foreach($data as $row){
                if($row->status == "Terpenuhi"){
                    $warna = 'bg-deepblue';
                }elseif ($row->status == "Dalam Proses"){
                    $warna = 'bg-blue';
                }elseif ($row->status == "Tidak Ada Bukti"){
                    $warna = 'bg-yellow';
                }elseif ($row->status == "Gagal"){
                    $warna = 'bg-orange';
                }else{
                    $warna = 'bg-grey';
                }
                $output .= '
                    <li>
                    <a href="'.url('/detail').'/'.$row->slug.'" class="fade">
                        <div class="debox '.$warna.'">
                            <h3 class="title">'.$row->status.'</h3>
                            <h5>'.strtoupper($row->topik).'</h5>
                            <h3>'.$row->judul.'</h3>
                        </div>
                    </a>
                    </li>
                ';
                $last_id = $row->updated_at;
            }
            $output .= '</ul>';
            if ($all == 'ada') {
            $output .= '
            <div id="load" class="centering margin-top margin-bottom-lg">
				<button type="button" name="load_more_button" class="btn-load cl-black bg-white fade" data-id="'.$last_id.'" id="load_more_button">Muat lagi...</a>
			</div>
            ';
            }
        }else{
            $output .= '
            <div class="centering margin-top margin-bottom-lg">
                <button type="button" name="load_more_button" class="btn-load cl-black bg-white fade">No Data Found</a>
            </div>
            ';
        }

        $chart = [$jumlah_janji,$terpenuhi,$proses,$bukti,$gagal,$verifikasi];
        return array($output, $chart);
        }       
    }

}
