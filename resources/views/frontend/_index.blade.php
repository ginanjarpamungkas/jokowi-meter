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
		<center><div id="chart-preview">
		<canvas class="chart" id="myChart"></canvas>
	</div>
	<h5 class="detail-chart hide_desktop">Tab untuk Detail</h5></center>
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
		<footer>
			<div class="box50">
				<p class=" cl-white">Selain memeriksa pemenuhan janji pemerintahan Presiden Joko Widodo dan Wakil Presiden Jusuf Kalla, kami juga melakukan social listening atau pemantauan persepsi publik di media sosial terhadap topik-topik terkait berbagai janji tersebut.</p>
				<p class=" cl-white">Kami bekerja sama dengan NoLimit, perusahaan teknologi yang berfokus pada pemantauan dan analisis media daring. Pemantauan ini menyasar percakapan-percakapan di media sosial terkait topik-topik janji Jokowi-JK, baik yang mengandung sentimen netral, sentimen positif, maupun sentimen negatif. Data-data terkait percakapan itu diambil selama periode kepemimpinan Jokowi-JK.</p>
			</div>
			<div class="box50" style="padding: 0 !important">
				<center>
					<canvas id="pieChart" width=250 height=250></canvas>
				</center>
			</div>
		</footer>
		<div class="container-col">
			<div class="box50">
				<h2 class="title cl-white">ADA JANJI YANG<br>TIDAK DI SINI?<br>LAPORKAN!</h2>
				<p class=" cl-white">Apakah Anda merasa ada janji Presiden Joko Widodo yang tidak ada di laman ini? Kirimkan pesan kepada kami melalui formulir di samping ini.</p>
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
<script src="https://rawgit.com/chartjs/chartjs.github.io/master/dist/master/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>
{{-- <script src="{{asset('dashboard/bower_components/chart.js/Chart.js')}}"></script> --}}
<script>
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");
	});
	
</script>
<script>
var data = {
  labels: [
    "Red",
    "Blue",
    "Yellow"
  ],
  datasets: [
    {
      data: [300, 50, 100],
      backgroundColor: [
        "#FF6384",
        "#36A2EB",
        "#FFCE56"
      ],
      hoverBackgroundColor: [
        "#FF6384",
        "#36A2EB",
        "#FFCE56"
      ]
    }]
};

var promisedDeliveryChart = new Chart(document.getElementById('myChart'), {
  type: 'doughnut',
  data: data,
  options: {
  	responsive: true,
    legend: {
      display: false
    }
  }
});

Chart.pluginService.register({
  beforeDraw: function(chart) {
    var width = chart.chart.width,
        height = chart.chart.height,
        ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = (height / 114).toFixed(2);
    ctx.font = fontSize + "em sans-serif";
    ctx.textBaseline = "middle";

    var text = "75%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;

    ctx.fillText(text, textX, textY);
    ctx.save();
  }
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

<script id="script-construct">
	var chart = new Chart('pieChart', {
		type: 'outlabeledPie',
		data: {
			labels: [
				'Positif',
				'Negatif',
				'Netral'
			],
			datasets: [{
				backgroundColor: [
					'#0F9D58',
					'#DB4437',
					'#686868',
				],
				data: [1, 3, 96]
			}]
		},
		options: {
			zoomOutPercentage: 55, // makes chart 55% smaller (50% by default, if the preoprty is undefined)
			plugins: {
				legend: false,
				outlabels: {
					text: '%l %p',
					color: 'white',
					stretch: 15,
					font: {
						resizable: true,
						minSize: 10,
						maxSize: 18
					}
				},
				padding:0,
			}
		}
	});
</script>
@endsection
<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"indicator_box\" style=\"padding:1px 10px;border-radius: 50%;background-color:<%=segments[i].fillColor%>\"></span><span><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>
$('#legend').html(myPieChart.generateLegend());

var data = [
	{
        value: 99,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Positif"
    },{
        value: 9,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Negatif"
    },
    {
        value: 99,
        color: "#686868",
        highlight: "#686868",
        label: "Netral"
    }
];

var canvas = document.getElementById("pieChart");
var ctx = canvas.getContext("2d");
var midX = canvas.width/2;
var midY = canvas.height/2

// Create a pie chart
var myPieChart = new Chart(ctx).Pie(data, {
    showTooltips: true,
	onAnimationProgress: drawSegmentValues,
	legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"indicator_box\" style=\"padding:1px 10px;border-radius: 50%;background-color:<%=segments[i].fillColor%>\"></span><span><%if(segments[i].label){%><%=segments[i].label%><%}%></span></li><%}%></ul>"
});

$('#legend').html(myPieChart.generateLegend());
var radius = myPieChart.outerRadius;

function drawSegmentValues()
{
    for(var i=0; i<myPieChart.segments.length; i++) 
    {
        ctx.fillStyle="Black";
		if ($(window).width() > 1024) {
			var textSize = canvas.width/10;
		}else if ($(window).width() > 768) {
			var textSize = canvas.width/20;
		}else{
			var textSize = canvas.width/40;
		}
        ctx.font= textSize+"px Verdana";
        // Get needed variables
        var value = myPieChart.segments[i].value+'%';
        var startAngle = myPieChart.segments[i].startAngle;
        var endAngle = myPieChart.segments[i].endAngle;
        var middleAngle = startAngle + ((endAngle - startAngle)/2);

        // Compute text location
        var posX = (radius/2) * Math.cos(middleAngle) + midX;
        var posY = (radius/2) * Math.sin(middleAngle) + midY;

        // Text offside by middle
        var w_offset = ctx.measureText(value).width/2;
        var h_offset = textSize/4;

        ctx.fillText(value, posX - w_offset, posY + h_offset);
    }
}