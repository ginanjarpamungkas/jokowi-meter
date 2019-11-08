@extends('frontend.layout')
@section('metatag')
<title>Tempo.co - Janji Jokowi | Tentang Proyek</title>
<link rel="shortcut icon" href="https://interaktif.tempo.co/frontend/interaktif/favicon.ico" type="image/x-icon" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <meta http-equiv="refresh" content="900"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
<meta name="language" content="id" />
<meta name="title" content="Tempo.co - Janji Jokowi"/>
<meta name="description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo." />
<meta property="og:url" content="https://janjijokowi.tempo.co" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Tempo.co - Janji Jokowi" />
<meta property="og:description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo." />
<meta property="og:image" content="https://janjijokowi.tempo.co/frontend/images/jokowi.png" />
<meta property="og:image" content="{{asset('frontend/images/jokowi.png')}}">
<meta http-equiv="pragma" content="no cache">
<meta name="author" content="Tempo.co">
<meta name="keywords" content="janji jokowi, jokowi, presiden, indonesia, janji presiden, presiden indonesia, politik, kampanye, prabowo, pemilu">
<meta name="description" content="Sebuah pengukur janji yang merupakan bagian dari kerja tim kanal Cek Fakta Tempo.">
<meta name="copyright" content="">
<meta name="coverage" content="WorldWide">
<meta name="creation date" content="28 September 2019">
<meta name="title" content="Tempo.co - Janji Jokowi">
<meta name="rating" content="General">
<meta name="robots" content="follow">
<meta name="twitter:image" content="{{asset('frontend/images/jokowi.png')}}">
<link itemprop="thumbnailUrl" href="url_gambar"> <span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject"> <link itemprop="url" href="{{asset('frontend/images/jokowi.png')}}"> </span>
@endsection
@section('header')
	<style>
	ul.box-color li .debox p {overflow: visible;}
	ul.box-color li .debox {height: 400px;}
	</style>
@endsection
@section('content')
<div class="container smaller">
				<div class="container-col">
					<div class="box100 margin-top">
						<h2 class="title t-center">TENTANG<br>PROYEK<br>INI</h2>
						<div class="blockbox">
							<div class="text-frame">
								<p>Janji Jokowi adalah sebuah situs pengukur janji (<font style="font-style:italic">promise tracker</font>) hasil kerja tim Medialab Tempo.co. Situs ini dibuat sebagai sarana untuk memantau upaya pemerintahan Presiden Joko Widodo dalam memenuhi janji-janji kampanye untuk rakyat Indonesia.</p>
								<p>Dengan memberikan penilaian berbasis data yang objektif dan akurat tentang bagaimana Joko Widodo memenuhi mandat pemilihnya, maka pengukur janji ini memungkinkan warga sipil memantau kerja pemerintah.  Selain itu, situs ini juga bertujuan untuk meningkatkan literasi warga, menangkal kampanye mis/disinformasi seputar kinerja pemerintah serta mendorong akuntabilitas pejabat publik.</p>
							</div>
						</div>
					</div>
					<div class="box100 margin-top">
						<h2 class="title t-center">INDIKATOR</h2>
						<div class="blockbox">
							<div class="text-frame no-border padding-left-no padding-right-no">
								<ul class="box-color col2">
									<li>
										<a href="{{route('status','terpenuhi')}}" class="fade">
										<div class="debox bg-deepblue">
											<h3 class="title">Terpenuhi</h3>
											<p>Sebuah janji disebut “terpenuhi” ketika pemerintah berhasil memenuhi target yang mereka tetapkan dalam program kampanye. Data dan bukti yang digunakan untuk menetapkan status ini akan dicantumkan selengkap mungkin. Pemeriksa fakta kami menghindari menggunakan asumsi-asumsi dalam menetapkan sebuah status.</p>
										</div>
										</a>
									</li>
									<li>
										<a href="{{route('status','dalam-proses')}}" class="fade">
										<div class="debox bg-blue">
											<h3 class="title">Dalam Proses</h3>
											<p>Status ini diberikan apabila sebuah janji kampanye masih dalam proses pemenuhan. Janji dalam kategori ini kelak bisa berubah menjadi “terpenuhi” atau “gagal”.</p>
										</div>
										</a>
									</li>
									<li>
										<a href="{{route('status','tidak-ada-bukti')}}" class="fade">
										<div class="debox bg-yellow">
											<h3 class="title">Tidak Ada Bukti</h3>
											<p>Status ini diberikan ketika pemeriksa fakta kami tidak bisa menemukan bukti atau data apapun dalam catatan publik, mengenai dipenuhi tidaknya sebuah janji kampanye. Semua janji kampanye pada awalnya akan diberikan status ini, sampai ada bukti dan data yang bisa mengindikasikan  terpenuhi tidaknya target yang ditetapkan pemerintah.</p>
										</div>
										</a>
									</li>
									<li>
										<a href="{{route('status','gagal')}}" class="fade">
										<div class="debox bg-orange">
											<h3 class="title">Gagal</h3>
											<p>Sebuah janji disebut “gagal” bila pemerintah tegas-tegas menyatakan tidak berencana lagi untuk meneruskan pemenuhan janji itu, atau mengambil kebijakan yang bertentangan dengan upaya memenuhi janji tersebut. Jadi, sebuah janji tidak lantas disebut “gagal” hanya karena tidak ada bukti kemajuan yang bisa ditemukan dalam catatan publik.</p>
										</div>
										</a>
									</li>
									<li style="float:none !important">
										<a href="{{route('status','tidak-terverifikasi')}}" class="fade">
										<div class="debox bg-grey">
											<h3 class="title">Tidak Terverifikasi</h3>
											<p>Sebuah janji diberikan status ini jika tidak ada parameter yang bisa diukur di dalamnya. Pencantuman janji ini diperlukan agar pembaca tetap dapat memahami keseluruhan janji kampanye presiden terpilih.</p>
										</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box100 margin-top">
						<h2 class="title t-center">TIM<br>PROYEK<br></h2>
						<div class="blockbox">
							<div class="text-frame">
								<ul class="credit-parent">
									<ol class="credit-child"><b>PENANGGUNG JAWAB : </b> Wahyu Dhyatmika</ol>
									<ol class="credit-child"><b>KEPALA PROYEK : </b> Angelina Anjar</ol>
									<ol class="credit-child"><b>PERISET : </b> Balqis Hijrah, Muhammad Fatih, Nurmaulida</ol>
									<ol class="credit-child"><b>MULTIMEDIA : </b> Moerat Sitompul, Krisna Pradipta, Sunardi Alunay, Ginanjar Pamungkas</ol>
									<ol class="credit-child"><b>IDE AWAL : </b> Ajeng Astudestra</ol>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="container full padding-no bg-d3 overflow clear">
	<div class="container padding-top padding-bottom overflow">
		<div class="container-col">
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
$(window).load(function() {
	$(".se-pre-con").fadeOut("slow");
});
</script>
@endsection