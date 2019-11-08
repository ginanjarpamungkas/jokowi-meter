@extends('frontend.layout')
@section('metatag')
<title>Tempo.co - Janji Jokowi | {{$promises->judul}}</title>
<link rel="shortcut icon" href="https://interaktif.tempo.co/frontend/interaktif/favicon.ico" type="image/x-icon" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="900"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
<meta name="language" content="id" />
<meta name="title" content="{{$promises->judul}}"/>
<meta name="description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo." />
<meta property="og:url" content="https://janjijokowi.tempo.co" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$promises->judul}}" />
<meta property="og:description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo." />
<meta property="og:image" content="https://janjijokowi.tempo.co/frontend/images/jokowi.png" />
<meta property="og:image" content="{{asset('frontend/images/jokowi.png')}}">
<meta http-equiv="pragma" content="no cache">
<meta name="author" content="Tempo.co">
<meta name="keywords" content="{{$promises->tags}}">
<meta name="description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo.">
<meta name="copyright" content="">
<meta name="coverage" content="WorldWide">
<meta name="creation date" content="28 September 2019">
<meta name="title" content="{{$promises->judul}}">
<meta name="rating" content="General">
<meta name="robots" content="follow">
<meta name="twitter:image" content="{{asset('frontend/images/jokowi.png')}}">
<link itemprop="thumbnailUrl" href="url_gambar"> <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject"> <link itemprop="url" href="{{asset('frontend/images/jokowi.png')}}"> </span>
@endsection
@section('header')
<link rel="stylesheet" href="{{asset('frontend/css/colapse.css')}}">
<style>
	.logo-top{
		top: 0 !important
	}
</style>
@endsection
@section('content')
<div class="margin-top"></div>
			<div class="box70">
				<article>
				<div class="blockbox">
					<h2 class="title">{{$promises->topik}}</h2>
					<h1 class="title @if ($promises->status == 'Terpenuhi'){{'cl-deepblue'}} @elseif ($promises->status == 'Dalam Proses') {{'cl-blue'}} @elseif ($promises->status == 'Tidak Ada Bukti') {{'cl-yellow'}} @elseif ($promises->status == 'Tidak Terverifikasi') {{'cl-grey'}} @else {{'cl-orange'}} @endif">
                        {{$promises->judul}}
					</h1>
					<div class="text-frame">
					@foreach ($promises->detail as $item)
					@if ( $item->keterangan == 'Publish')	
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" class="collapsed" aria-expanded="false">
							<div class="box-header">
								<h3 style="border-bottom: 5px solid black;" class="title"><i class="fa fa-plus-circle"></i> Update {{date_format($item->updated_at,"d F Y - H:i:s")}}</h3>
							</div>
						</a>
						<div id="collapse{{$item->id}}" class="panel-collapse collapse in" aria-expanded="true">
							<div class="card card-body" style="margin-top:13px">
								<?php echo $item->deskripsi?>
							</div>
						</div>
					@endif
					@endforeach
					</div>
				</div>
				</article>
			</div>
			<div class="box30">
				<div class="blockbox">
					<h2 class="baru">PALING BARU</h2>
					<ul class="box-color col1">
						@if (!empty($terpenuhi))	
						<li>
							<a href="{{route('front.detail',$terpenuhi->slug)}}" class="fade">
							<div class="debox bg-deepblue">
								<h3 class="title">{{$terpenuhi->status}}</h3>
								<h5>{{strtoupper($terpenuhi->topik)}}</h5>
								<h3>{{$terpenuhi->judul}}</h3>
							</div>
							</a>
						</li>
						@endif
						@if (!empty($proses))
						<li>
							<a href="{{route('front.detail',$proses->slug)}}" class="fade">
							<div class="debox bg-blue">
								<h3 class="title">{{$proses->status}}</h3>
								<h5>{{strtoupper($proses->topik)}}</h5>
								<h3>{{$proses->judul}}</h3>
							</div>
							</a>
						</li>
						@endif
						@if (!empty($bukti))	
						<li>
							<a href="{{route('front.detail',$bukti->slug)}}" class="fade">
							<div class="debox bg-yellow">
								<h3 class="title">{{$bukti->status}}</h3>
								<h5>{{strtoupper($bukti->topik)}}</h5>
								<h3>{{$bukti->judul}}</h3>
							</div>
							</a>
						</li>
						@endif
						@if (!empty($gagal))	
						<li>
							<a href="{{route('front.detail',$gagal->slug)}}" class="fade">
							<div class="debox bg-orange">
								<h3 class="title">{{$gagal->status}}</h3>
								<h5>{{strtoupper($gagal->topik)}}</h5>
								<h3>{{$gagal->judul}}</h3>
							</div>
							</a>
						</li>
						@endif
						@if (!empty($verifikasi))
						<li>
							<a href="{{route('front.detail',$verifikasi->slug)}}" class="fade">
							<div class="debox bg-grey">
								<h3 class="title">{{$verifikasi->status}}</h3>
								<h5>{{strtoupper($verifikasi->topik)}}</h5>
								<h3>{{$verifikasi->judul}}</h3>
							</div>
							</a>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
<div class="container full padding-no bg-d3 overflow clear">
	<div class="container padding-top padding-bottom overflow">
		<div class="container-col">
@endsection
@section('footer')
<script src="{{asset('dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>    
<script>
$(window).load(function() {
	$(".se-pre-con").fadeOut("slow");
});
</script>
@endsection