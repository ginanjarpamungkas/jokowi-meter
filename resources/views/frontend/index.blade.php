@extends('frontend.layout')
@section('metatag')
<title>Tempo.co - Janji Jokowi</title>
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
@section('content')
<div class="box-100 margin-top">
	<div id="chart-preview">
		<canvas class="chart" id="myChart"></canvas>
	</div>
	<center><h5 class="detail-chart hide_desktop">Tab untuk Detail</h5></center>
</div>
			<div class="container centering">
				<div class="pilih-inside">
					<div class="area100">
						<div class="pilih-area"> 
						<form action="{{route('search')}}" method="GET">
							<button class="form-icon" style="right:0; background:#ddd; color:#333; padding:0; left:auto; border:none;"><i class="fa fa-search"></i></button>
							<input id="search" type="text" class="form-area" name="key" required placeholder="cari janji yang ingin ditagih" style="padding-right:52px;" value="">
						</form>
						</div>
					</div>
					<div class="container-col">
					<div class="area50">
						<div class="pilih-area">
							<select class="form-area" id="periode">
								<option value="">Periode</option>
								<option value="Periode 1">2014 - 2019</option>
								<option value="Periode 2">2019 - 2024</option>
							</select>
						</div>
					</div>
					<div class="area50">
						<div class="pilih-area">
							<select class="form-area" id="topik">
								<option value="">Topik</option>
								@foreach ($topik as $item)
									<option value="{{$item->nama}}">{{$item->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="block-button">
			<div class="block-button-in">
				<div class="button-img">
					<center><a href="{{route('status','terpenuhi')}}"><img src="{{asset('frontend/images/green.png')}}" width="120px"></a></center>
					<a href="{{route('status','terpenuhi')}}" class="btn-big bg-deepblue cl-white fade">Terpenuhi</a>
				</div>
				<div class="button-img">
					<center><a href="{{route('status','dalam-proses')}}"><img src="{{asset('frontend/images/yellow.png')}}" width="120px"></a></center>
					<a href="{{route('status','dalam-proses')}}" class="btn-big bg-blue cl-white fade">Dalam Proses</a>
				</div>
				<div class="button-img">
					<center><a href="{{route('status','tidak-ada-bukti')}}"><img src="{{asset('frontend/images/blue.png')}}" width="120px"></a></center>
					<a href="{{route('status','tidak-ada-bukti')}}" class="btn-big bg-yellow cl-white fade">Tidak Ada Bukti</a>
				</div>
				<div class="button-img">
					<center><a href="{{route('status','gagal')}}"><img src="{{asset('frontend/images/red.png')}}" width="120px"></a></center>
					<a href="{{route('status','gagal')}}" class="btn-big bg-orange cl-white fade">Gagal</a>
				</div>
				<div class="button-img">
					<center><a href="{{route('status','tidak-terverifikasi')}}"><img src="{{asset('frontend/images/grey.png')}}" width="120px"></a></center>
					<a href="{{route('status','tidak-terverifikasi')}}" class="btn-big bg-grey cl-white fade">Tidak Terverifikasi</a>
				</div>
				<div class="swipe hide_desktop">
					<img src="{{asset('frontend/images/swipe.png')}}" width="30px">
				</div>
			</div>
		</div>
		{{ csrf_field() }}
		<div id="data">
            @if (empty($promises))
            <div class="centering margin-top margin-bottom-lg">
                <button type="button" name="load_more_button" class="btn-load cl-black bg-white fade">No Data Found</a>
            </div>
            @endif
		</div>
	</div>
<div class="container full padding-no bg-d3 overflow">
	<div class="container padding-top padding-bottom overflow">
		<footer style="margin-bottom:5%" id="chart-nolimit">
			<div class="box50" style="padding: 0 !important;">
				<h2 class="title cl-darkgrey">PEMANTAUAN DAN ANALISIS MEDIA SOSIAL</h2>
				<p class=" cl-darkgrey">Selain memeriksa pemenuhan janji pemerintahan Presiden Joko Widodo dan Wakil Presiden Jusuf Kalla, kami juga melakukan social listening atau pemantauan persepsi publik di media sosial terhadap topik-topik terkait berbagai janji tersebut.</p>
				<p class=" cl-darkgrey">Kami bekerja sama dengan NoLimit, perusahaan teknologi yang berfokus pada pemantauan dan analisis media daring. Pemantauan ini menyasar percakapan-percakapan di media sosial terkait topik-topik janji Jokowi-JK, baik yang mengandung sentimen netral, sentimen positif, maupun sentimen negatif. Data-data terkait percakapan itu diambil selama periode kepemimpinan Jokowi-JK.</p>
			</div>
			<div class="box50" style="padding: 0 !important; position:relative">
				<center>
				<h2 class="title cl-darkgrey" id="chart-title">Hubungan Internasional</h2>
				<div id="chart-body">
					<canvas id="pieChart"></canvas>
				</div>
				<img id="button-next" data-id="2" class="btn-nolimit nolimit-arrow" style="right:10%" src="{{asset('frontend/images/arrow-right.png')}}" alt="">
				<img id="button-prev" data-id="15" class="btn-nolimit nolimit-arrow" style="left:10%" src="{{asset('frontend/images/arrow-left.png')}}" alt="">
				<h5 class="cl-darkgrey detail-chart hide_desktop">Tab untuk Detail</h5>
				<div id="legend">
					<ul class="pie-legend">
						<li><span class="indicator_box" style="padding:2px 11px;border-radius: 50%;background-color:#0F9D58;border:2px solid #fff"></span>&nbsp;<span>Positif</span></li>
						<li><span class="indicator_box" style="padding:2px 11px;border-radius: 50%;background-color:#DB4437;border:2px solid #fff"></span>&nbsp;<span>Negatif</span></li>
						<li><span class="indicator_box" style="padding:2px 11px;border-radius: 50%;background-color:#a9a9a6;border:2px solid #fff"></span>&nbsp;<span>Netral</span></li>
					</ul>
				</div></center>
			</div>
		</footer>
		<div class="container-col">
			<div class="box50">
				<h2 class="title cl-darkgrey">ADA JANJI YANG<br>TIDAK DI SINI?<br>LAPORKAN!</h2>
				<p class=" cl-darkgrey">Apakah Anda merasa ada janji Presiden Joko Widodo yang tidak ada di laman ini? Kirimkan pesan kepada kami melalui formulir di samping ini.</p>
			</div>
			<form action="{{route('sendemail')}}" method="post">
				@csrf
				<div class="box50">
					<div class="pilih-form">
						<div class="pilih-inside">
							<div class="area100">
								<div class="pilih-area">
									<input name="nama" type="text" class="form-area" id="name" placeholder="Nama" required>
								</div>
							</div>
							<div class="area100">
								<div class="pilih-area">
									<input name="email" type="email" class="form-area" id="email" placeholder="Email" required>
								</div>
							</div>
							<div class="area100">
								<div class="pilih-area">
									<textarea name="pesan" class="form-area" id="messages" style="height:98px;" placeholder="Pesan"></textarea>
								</div>
							</div>
							<div class="area100 centering">
								<button type="submit" class="send-button fade bg-white" style="color:black">SUBMIT</button>
							</div>
						</div>
					</div>
				</div>
			</form>
<input type="hidden" value="" id="status">
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>    
<!-- ChartJS -->
<script src="{{asset('dashboard/bower_components/chart.js/Chart.js')}}"></script>
<script src="{{asset('frontend/js/nolimit.js')}}"></script>
<script>
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");
	});
	
	if ($(window).width() > 420) {
		Chart.types.Doughnut.extend({
			name: "DoughnutTextInside",
			showTooltip: function() {
				this.chart.ctx.save();
				Chart.types.Doughnut.prototype.showTooltip.apply(this, arguments);
				this.chart.ctx.restore();
			},
			draw: function() {
				Chart.types.Doughnut.prototype.draw.apply(this, arguments);

				var width = this.chart.width,
					height = this.chart.height;

				var fontSize = (height / 125).toFixed(2);
				this.chart.ctx.font = fontSize + "em Verdana";
				this.chart.ctx.textBaseline = "middle";

				var text = "{{$all}}",
					textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
					textY = (height / 2) - 20;
				var text1 = "Janji",
					textX1 = Math.round((width - this.chart.ctx.measureText(text).width) - (textX+10)),
					textY1 = (height+10) - textY;

				this.chart.ctx.fillText(text, textX, textY);
				this.chart.ctx.fillText(text1, textX1, textY1);
			}
		});
    } else {
        Chart.types.Doughnut.extend({
			name: "DoughnutTextInside",
			showTooltip: function() {
				this.chart.ctx.save();
				Chart.types.Doughnut.prototype.showTooltip.apply(this, arguments);
				this.chart.ctx.restore();
			},
			draw: function() {
				Chart.types.Doughnut.prototype.draw.apply(this, arguments);

				var width = this.chart.width,
					height = this.chart.height;

				var fontSize = (height / 125).toFixed(2);
				this.chart.ctx.font = fontSize + "em Verdana";
				this.chart.ctx.textBaseline = "middle";

				var text = "{{$all}}",
					textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
					textY = (height / 2) - 5;
				var text1 = "Janji",
				    textX1 = Math.round((width - this.chart.ctx.measureText(text).width) - (textX+8)),
				    textY1 = (height+10) - textY;

				this.chart.ctx.fillText(text, textX, textY);
				this.chart.ctx.fillText(text1, textX1, textY1);
			}
		});
    }

var data = [
    {
        value    : {{$verifikasi}},
        color    : '#67615c',
        highlight: '#a9a9a6',
        label    : 'Tidak Terverifikasi'
    },
	{
        value    : {{$terpenuhi}},
        color    : '#0F9D58',
        highlight: '#0f9d29',
        label    : 'Terpenuhi'
    },
    {
        value    : {{$proses}},
		color    : '#F4B400',
        highlight: '#febd00',
        label    : 'Dalam Proses'
    },
    {
        value    : {{$bukti}},
        color    : '#017BC4',
        highlight: '#038fe3',
        label    : 'Tidak Ada Bukti'
    },
    {
        value    : {{$gagal}},
        color    : '#DB4437',
        highlight: '#db3a00',
        label    : 'Gagal'
    }];

var DoughnutTextInsideChart = new Chart($('#myChart')[0].getContext('2d')).DoughnutTextInside(data, {
    responsive: true
});
</script>
<script>
	$(document).ready(function(){
		var _token = $('input[name="_token"]').val();
		load_data('', _token);
		function load_data(id="", _token){
			$.ajax({
				url:"{{ route('loadmore') }}",
				method:"POST",
				data:{id:id, _token:_token},
				success:function(data){
					$('#load').remove();
					$('#data').append(data);
				}
			})
		}

		// loadmore button
		$(document).on('click', '#load_more_button', function(){
			var id = $(this).data('id');
			$('#load_more_button').html('<b>Loading...</b>');
			load_data(id, _token);
		});
	});
</script>
<script>
$('#periode').change(function(){
	var periode = $('#periode').val();
	var topik = $('#topik').val();
	var status = $('#status').val();
	var _token = $('input[name="_token"]').val();
	$.ajax({
		url:"{{ route('filter') }}",
		method:"GET",
		data:{_token:_token, periode:periode, topik:topik, status:status},
		success:function(data){
			$('#data').html(data[0]);
			$('#chart-preview').html('<canvas class="chart" id="myChart2"></canvas>');
			chartPreview(data[1]);
		}
	})
});

$('#topik').change(function(){
	var periode = $('#periode').val();
	var topik = $('#topik').val();
	var status = $('#status').val();
	var _token = $('input[name="_token"]').val();
	
	$('#chart-title').html(topik);
	$('#chart-body').html('<canvas id="pieChart"></canvas>');

	switch (topik) {
		case 'Hubungan Internasional':
			dataNolimit = [18,1,81];
			break;
		case 'Pertahanan dan Keamanan':
			dataNolimit = [3,5,92];
			break;
		case 'Informasi dan Layanan Publik':
			dataNolimit = [27,7,66];
			break;
		case 'Tata Kelola Pemerintahan':
			dataNolimit = [22,1,77];
			break;
		case 'Kebijakan Afirmatif':
			dataNolimit = [1,3,96];
			break;
		case 'Buruh Migran':
			dataNolimit = [2,11,87];
			break;
		case 'Penegakan Hukum':
			dataNolimit = [1,3,96];
			break;
		case 'Pertanian dan Reforma Agraria':
			dataNolimit = [4,0,96];
			break;
		case 'Energi':
			dataNolimit = [9,43,48];
			break;
		case 'Ketenagakerjaan':
			dataNolimit = [0,15,85];
			break;
		case 'Investasi':
			dataNolimit = [7,10,83];
			break;
		case 'Infrastruktur':
			dataNolimit = [7,1,92];
			break;
		case 'Maritim':
			dataNolimit = [17,2,81];
			break;
		case 'Pemerataan Pembangunan':
			dataNolimit = [1,5,94];
			break;
		case 'Pariwisata':
			dataNolimit = [7,0,93];
			break;
		case 'Perdagangan':
			dataNolimit = [4,1,95];
			break;
		default:
			dataNolimit = [3,2,95];
			break;
	}
	chartNolimit(dataNolimit);

	$.ajax({
		url:"{{ route('filter') }}",
		method:"GET",
		data:{_token:_token, periode:periode, topik:topik, status:status},
		success:function(data){
			$('#data').html(data[0]);
			$('#chart-preview').html('<canvas class="chart" id="myChart2"></canvas>');
			chartPreview(data[1]);
		}
	})
});

</script>
@endsection