@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Artikel
        <small>JokowiMETER</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('artikel.list')}}"><i class="fa fa-newspaper-o"></i> Artikel</a></li>
        <li class="active">Show</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{$artikel->judul}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-11 col-lg-9">
                        <center><h2><b>{{$artikel->judul}}</b></h2></center>
                        <img align="center" src="{{$artikel->foto}}" style="margin-top:15px;">
                        <div class="col-md-12">
                            <?php echo $artikel->isi;?>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-3">
                        <script id="twitter-wjs" type="text/javascript" async defer src="//platform.twitter.com/widgets.js"></script>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
</div>
@endsection
@section('footer')

@endsection