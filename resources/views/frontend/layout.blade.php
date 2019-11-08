<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:og="https://opengraphprotocol.org/schema/">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@yield('metatag')
<link rel="stylesheet" href="{{asset('frontend/css/fontface.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{asset('frontend/css/base.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{asset('frontend/css/mobile.css')}}" type="text/css" media="screen" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700&display=swap" rel="stylesheet">
<style>
.alert {position:fixed;left:3%;top:10%;z-index:1000;background: green;padding:10px 20px; color:white}
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url({{asset('/Preloader_11.gif')}}) center no-repeat #fff;
}
</style>
@yield('header')
<style>
@media screen and (min-width:1024px){
	.chart{width: 370px;height: 100px;}
	.nolimit-arrow:hover {opacity: 0.5;}
}
</style>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-23817453-1', 'auto', {'allowAnchor': true});
	ga('set', {
		page: '/'
	});

	ga('send', 'pageview', {
		hitType: 'pageview',
		page: location.pathname + location.search + location.hash
	});

</script>

<script type="text/javascript">
_atrk_opts = { atrk_acct:"yIXbf1a0Ix00UK", domain:"tempo.co",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
</head>
<body>
<div class="se-pre-con"></div>
@include('include.header')
@if (session('success'))
	<div class="alert">
		<h4>Terimakasih</h4>
		{{session('success') }}
	</div>
@endif 
<main class="cd-main-content">
	<div class="container">
		<div class="mobile-menu hide_desktop">
			<a class="fade" href="/metodologi">metodologi</a>
        	<a class="fade" href="/about">tentang proyek ini</a>
		</div>
		<div class="logo-top"><img src="{{asset('frontend/images/signatory-logo.png')}}"></div>
		<div class="container-col">
			@yield('content')
			<footer style="margin-top:5%">
				<div class="footer-in">
					<p class="t-center cl-darkgrey"><strong>Proyek ini didukung oleh:</strong></p>
					<div class="foot-box margin-top">
						<div class="foot-logo"><a href="https://asl19.org/en/" target="_blank"><img src="{{asset('frontend/images/asl19-logo.png')}}"></a></div>
						<div class="foot-logo"><a href="https://rouhanimeter.com/fa/" target="_blank"><img src="{{asset('frontend/images/rouhani-logo.png')}}"></a></div>
						<div class="foot-logo"><a href="https://www.icfj.org/" target="_blank"><img src="{{asset('frontend/images/icfj-logo.png')}}"></a></div>
						<div class="foot-logo"><a href="http://nolimit.id" target="_blank"><img src="{{asset('frontend/images/nolimit.png')}}"></a></div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	
</div>

</main>
<script src="{{asset('frontend/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/all.js')}}"></script>
@yield('footer')

<script>
function chartPreview(e,warna) {
	
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

			var fontSize = (height / 150).toFixed(2);
			this.chart.ctx.font = fontSize + "em Verdana";
			this.chart.ctx.textBaseline = "middle";

			var text = ""+e[0]+" Janji",
				textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
				textY = height / 2;
			this.chart.ctx.fillStyle = warna;
			this.chart.ctx.fillText(text, textX, textY);
		}
	});

	var data = [
		{
			value    : e[5],
			color    : '#67615c',
			highlight: '#a9a9a6',
			label    : 'Tidak Terverifikasi'
		},
		{
			value    : e[1],
			color    : '#0F9D58',
			highlight: '#0f9d29',
			label    : 'Terpenuhi'
		},
		{
			value    : e[2],
			color    : '#F4B400',
			highlight: '#febd00',
			label    : 'Dalam Proses'
		},
		{
			value    : e[3],
			color    : '#017BC4',
			highlight: '#038fe3',
			label    : 'Tidak Ada Bukti'
		},
		{
			value    : e[4],
			color    : '#DB4437',
			highlight: '#db3a00',
			label    : 'Gagal'
		}];

	var DoughnutTextInsideChart = new Chart($('#myChart2')[0].getContext('2d')).DoughnutTextInside(data, {
		responsive: true
	});
	}
</script>


<script>
$(document).ready(function() {
	$('.alert').fadeOut(10000);
});
</script>
</body>
</html>