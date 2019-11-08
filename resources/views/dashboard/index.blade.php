@extends('dashboard.layout')
@section('header')
<style>
    .block-button{width:100%; padding:15px 0 60px 0;}
    .block-button-in{width:100%; display: flex; align-items:center; justify-content:space-around; flex-direction:row; padding:0;}
    .block-button a{width:200px;}
    a.btn-big{height:46px; display: flex; align-items:center; justify-content: center;padding:0 30px; margin:0; border-radius:23px; background:rgba(0,0,0,0.1); font-weight:600; min-width:150px;}
    a.btn-big:hover{opacity:0.8;}
    a.btn-big.clean{ border:1px solid #fff; background:rgba(0,0,0,0.1);}
    .cl-white{color:#fff !important;}
    .bg-deepblue{background: #0F9D58 !important;}
    .bg-blue{background: #F4B400 !important;}
    .bg-yellow{background: #017BC4 !important;}
    .bg-orange{background: #DB4437 !important;}
    .bg-grey{background:  #67615c !important;}
    .nomer {background: black;padding:5px 10px;color: white;}
</style>
@endsection
@section('content')
    <section class="content-header">
        <h1>
        Dashboard
        <small>JanjiJOKOWI</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('jm.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <canvas id="pieChart" style="height: 100px; width: 370px;" width="370" height="185"></canvas>
            <div class="block-button">
                <div class="block-button-in">
                    <div class="button-img">
                        <center><a href="{{route('status','terpenuhi')}}"><img src="{{asset('frontend/images/green.png')}}" width="120px"></a></center>
                        <a href="{{route('status','terpenuhi')}}" class="btn-big bg-deepblue cl-white "><i class="nomer">{{$terpenuhi}}</i> Terpenuhi</a>
                    </div>
                    <div class="button-img">
                        <center><a href="{{route('status','dalam-proses')}}"><img src="{{asset('frontend/images/yellow.png')}}" width="120px"></a></center>
                        <a href="{{route('status','dalam-proses')}}" class="btn-big bg-blue cl-white "><i class="nomer">{{$proses}}</i> Dalam Proses</a>
                    </div>
                    <div class="button-img">
                        <center><a href="{{route('status','tidak-ada-bukti')}}"><img src="{{asset('frontend/images/blue.png')}}" width="120px"></a></center>
                        <a href="{{route('status','tidak-ada-bukti')}}" class="btn-big bg-yellow cl-white "><i class="nomer">{{$bukti}}</i> Tidak Ada Bukti</a>
                    </div>
                    <div class="button-img">
                        <center><a href="{{route('status','gagal')}}"><img src="{{asset('frontend/images/red.png')}}" width="120px"></a></center>
                        <a href="{{route('status','gagal')}}" class="btn-big bg-orange cl-white "><i class="nomer">{{$gagal}}</i> Gagal</a>
                    </div>
                    <div class="button-img">
                        <center><a href="{{route('status','tidak-terverifikasi')}}"><img src="{{asset('frontend/images/grey.png')}}" width="120px"></a></center>
                        <a href="{{route('status','tidak-terverifikasi')}}" class="btn-big bg-grey cl-white "><i class="nomer">{{$verifikasi}}</i> Tidak Terverifikasi</a>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>
@endsection
@section('footer')
<script>
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

        var text = "{{$all}} Janji",
            textX = Math.round((width - this.chart.ctx.measureText(text).width) / 2),
            textY = height / 2;

        this.chart.ctx.fillText(text, textX, textY);
    }
});

var data = [
    {
        value    : {{$verifikasi}},
        color    : '#67615c',
        highlight: '#a9a9a6',
        label    : 'Tidak Terverifikasi'
    },{
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

var DoughnutTextInsideChart = new Chart($('#pieChart')[0].getContext('2d')).DoughnutTextInside(data, {
    responsive: true
});
</script>
@endsection