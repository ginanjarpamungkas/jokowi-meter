@extends('dashboard.layout')
@section('header')
  <link href="{{asset('dashboard/css/tagsinput.css')}}" rel="stylesheet">
@endsection
@section('content')
    <section class="content-header">
        <h1>
        Promises
        <small>JanjiJOKOWI</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('promises.list')}}"><i class="fa fa-bullhorn"></i> Promises</a></li>
        <li class="active">Create</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Janji Jokowi  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('promises.store')}}" method="POST" role="form">
                    @csrf
                <!-- text input -->
                <div class="form-group">
                    <label>Judul</label>
                    <input name="judul" type="text" class="form-control" placeholder="Judul Janji" required>
                </div>

                <div class="form-group">
                    <label>Topik</label>
                    <select name="topik" class="form-control" required>
                    <option value="">- Pilih Topik Janji -</option>
                    @foreach ($topik as $item)    
                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                    <option value="">- Pilih Status Janji -</option>
                    @foreach ($status as $item)    
                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Periode Kepresidenan</label>
                    <select name="periode" class="form-control" required>
                    <option value="">- Pilih Periode Janji -</option>
                    @foreach ($periode as $item)    
                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Save as</label>
                    <select name="keterangan" class="form-control" required>
                    <option value="">- Pilih Keterangan -</option>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi Janji</label>
                    <textarea name="isi" rows="10" cols="80" required></textarea>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <input type="text" data-role="tagsinput" value="{{ old('tags') }}" name="tags" placeholder="Pisah dengan tanda koma (,)" required>
                </div>
                <button type="submit" class="btn btn-primary col-lg-12">Save</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
</div>
@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="{{asset('dashboard/js/tagsinput.js')}}"></script>
<script>
    var route_prefix = "{{ url(config('lfm.url_prefix')) }}";
</script>

<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
</script>

<script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
</script>
<script>
        CKEDITOR.replace( 'isi', {
            height: 500,
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
        });
    </script>
@endsection