@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Promises
        <small>JanjiJOKOWI</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('promises.list')}}"><i class="fa fa-bullhorn"></i> Promises</a></li>
        <li class="active"> Show</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
            <ul class="timeline">
                <li class="time-label">
                    <span class="bg-red">
                    {{$promises->judul}}
                    </span>
                </li>
                <li>
                    <i class="fa fa-puzzle-piece bg-blue"></i>
    
                    <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{$promises->created_at}}</span>
    
                    <h3 class="timeline-header">Detail <a href="#">{{$promises->judul}}</a></h3>
    
                    <div class="timeline-body">
                        <div class="row"><div class="col-md-6">
                        <table class="table table-responsive">
                            <tr>
                                <td>Topik</td><td>:</td><td>{{$promises->topik}}</td>
                            </tr>
                            <tr>
                                <td>Status</td><td>:</td><td>{{$promises->status}}</td>
                            </tr>
                            <tr>
                                <td>Periode</td><td>:</td><td>{{$promises->periode}}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td><td>:</td><td><span class="label {{( $promises->keterangan == 'Draft') ? 'label-danger' : 'label-success'}}">{{( $promises->keterangan == 'Draft') ? 'Draft' : 'Publish'}}</span></td>
                            </tr>
                        </table>
                    </div></div>
                    </div>
                    </div>
                </li>
                @foreach ($detail as $item)
                <li>
                    <i class="fa fa-comments bg-yellow"></i>
    
                    <div class="timeline-item">
                        <div class="panel box box-success">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" class="collapsed" aria-expanded="false">
                            <div style="background:#222d32; color:white" class="box-header with-border">
                                <h4 class="box-title">
                                    {{date_format($item->updated_at,"d F Y - H:i:s")}}
                                </h4>
                            <i class="fa fa-plus pull-right"></i>
                            </div>
                            </a>
                            <div id="collapse{{$item->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <label for="desk">Deskripsi :</label>
                                    <p id="desk"><?php echo $item->deskripsi ?></p>

                                    <label for="sta">Status :</label>&nbsp;{{$item->status}}<br>

                                    <label for="ket">Keterangan : </label>
                                    <span id="ket" class="label {{( $item->keterangan == 'Draft') ? 'label-danger' : 'label-success'}}">{{( $item->keterangan == 'Draft') ? 'Draft' : 'Publish'}}</span>
                                    <hr>
                                <a class="btn btn-primary" id-detail="{{$item->id}}" data-toggle="modal" href='#modal-id{{$item->id}}'><i class="fa fa-edit"> Edit</i></a>
                                <a class="deleteDetail btn btn-danger" href="{{route('detail.delete',$item->id)}}"><i class="fa fa-trash"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                <li>
                    <i class="fa fa-plus bg-green"></i>

                    <div class="timeline-item">
                        <h3 class="timeline-header no-border"><a class="btn btn-primary" data-toggle="modal" href='#modal-tambah'><i class="fa fa-plus"> Tambah Detail</i></a></h3>
                    </div>
                </li>
                </ul>
            </div>
            <!-- /.col -->
        </div>   
    </section>
</div>
@php
    $counts = 0;
@endphp
@foreach ($detail as $item)
<div class="modal fade" id="modal-id{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Detail</h4>
            </div>
        <form action="{{route('detail.update')}}" method="post">
        @csrf
        <input type="hidden"  id="id" name="id" value="{{$item->id}}">
        <input type="hidden"  id="promise_id" name="promise_id" value="{{$promises->id}}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="des">Deskripsi :</label>
                <textarea name="deskripsi" id="deskripsi{{$counts}}" cols="30" rows="10">{{$item->deskripsi}}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control" required>
                    <option value="{{$item->status}}">{{$item->status}}</option>
                    @foreach ($status as $items)    
                    <option value="{{$items->nama}}">{{$items->nama}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-control" required>
                    <option value="{{$item->keterangan}}">{{$item->keterangan}}</option>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
@php
    $counts++;
@endphp
@endforeach
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Detail</h4>
            </div>
        <form action="{{route('detail.save')}}" method="post">
        @csrf
        <input type="hidden"  id="promise_id" name="promise_id" value="{{$promises->id}}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="des">Deskripsi :</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control" required>
                    <option value="">- Pilih Status -</option>
                    @foreach ($status as $item)    
                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-control" required>
                    <option value="">- Pilih Keterangan -</option>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    jQuery(document).ready(function($){
        $('.deleteDetail').on('click',function(){
            var getLink = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((value) => {
                    if (value) {
                        window.location.href = getLink;
                    }else{
                        return false;
                    }
                });
            return false;
        });
    });
</script>
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
    CKEDITOR.replace( 'deskripsi', {
        height: 500,
        filebrowserImageBrowseUrl: route_prefix + '?type=Images',
        filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: route_prefix + '?type=Files',
        filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
</script>
<script>
    $( document ).ready(function() {
        var count = <?php echo $counts?>;
        for ( var i = 0; i < count; i++){
            CKEDITOR.replace( 'deskripsi'+i, {
                height: 500,
                filebrowserImageBrowseUrl: route_prefix + '?type=Images',
                filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: route_prefix + '?type=Files',
                filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
            });
        }
    });
</script>
@endsection