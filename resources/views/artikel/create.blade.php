@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Artikel
        <small>JanjiJOKOWI</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('artikel.list')}}"><i class="fa fa-newspaper-o"></i> Artikel</a></li>
        <li class="active">Create</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Artikel Janji Jokowi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('artikel.store')}}" method="POST" role="form">
                    @csrf
                <!-- text input -->
                <div class="form-group">
                    <label>Judul<span class="required">*</span></label>
                    <input name="judul" type="text" class="form-control" placeholder="Judul Artikel" required>
                </div>
                <div class="form-group">
                <label>Thumbnail Artikel<span class="required">*</span></label>
                <div>
                    <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="foto" placeholder="Image size Max: 2 Mb">
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;"><br>
                </div>
                </div>
                <div class="form-group">
                    <label>Save as<span class="required">*</span></label>
                    <select name="keterangan" class="form-control" required>
                    <option value="">- Pilih Keterangan -</option>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Isi Artikel<span class="required">*</span></label>
                    <textarea name="isi" required></textarea>
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