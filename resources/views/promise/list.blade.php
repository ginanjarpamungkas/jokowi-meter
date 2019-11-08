@extends('dashboard.layout')
@section('header')
  <link href="{{asset('dashboard/css/tagsinput.css')}}" rel="stylesheet">
  <style>
      tr.data:hover {
          background-color: aqua !important;
      }
  </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>
        Promises
        <small>JanjiJOKOWI</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('promises.list')}}"><i class="fa fa-bullhorn"></i> Promises</a></li>
        <li class="active">List</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Janji Jokowi Selama 2 Periode</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">Judul</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Periode</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Topik</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Keterangan</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($promises as $promise)    
                                    <tr role="row" class="odd data">
                                    <td data-id="{{$promise->id}}" class="sorting_1">{{$promise->judul}}</td>
                                    <td data-id="{{$promise->id}}">{{$promise->periode}}</td>
                                    <td data-id="{{$promise->id}}">{{$promise->topik}}</td>
                                    <td data-id="{{$promise->id}}">{{$promise->status}}</td>
                                    <td data-id="{{$promise->id}}"><span class="label {{( $promise->keterangan == 'Draft') ? 'label-danger' : 'label-success'}}">{{( $promise->keterangan == 'Draft') ? 'Draft' : 'Publish'}}</button></td>
                                    <td data-id="{{$promise->id}}">
                                        <a class="btn btn-xs btn-default btnEdit" id-detail="{{$promise->id}}" data-toggle="modal" href='#modal-id'><i class="fa fa-edit"></i></a>
                                        <a href="{{route('promises.show',$promise->slug)}}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                                        <button class="delete btn btn-xs btn-danger" data-id="{{$promise->id}}"><i class="fa fa-trash"></i></button>
                                    </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Judul</th>
                                        <th rowspan="1" colspan="1">Periode</th>
                                        <th rowspan="1" colspan="1">Topik</th>
                                        <th rowspan="1" colspan="1">Status</th>
                                        <th rowspan="1" colspan="1">Keterangan</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                    </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Promise</h4>
            </div>
        <form action="{{route('promises.update')}}" method="post">
        @csrf
        <input type="hidden"  id="id" name="id" value="">
            <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input id="judul" name="judul" type="text" class="form-control" placeholder="Judul Janji" required>
                    </div>
    
                    <div class="form-group">
                        <label>Topik</label>
                        <select id="topik" name="topik" class="form-control" required>
                        @foreach ($topik as $item)    
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control" required>
                        @foreach ($status as $item)    
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label>Periode Kepresidenan</label>
                        <select id="periode" name="periode" class="form-control" required>
                        @foreach ($periode as $item)    
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tags</label>
                        <input id="tags" type="text" data-role="tagsinput" value="{{ old('tags') }}" name="tags" placeholder="Pisah dengan tanda koma (,)" required>
                    </div>
    
                    <div class="form-group">
                        <label>Save as</label>
                        <select id="keterangan" name="keterangan" class="form-control" required>
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
@endsection
@section('footer')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('dashboard/js/tagsinput.js')}}"></script>
<script>
$(".delete").click(function(){
    var $tr = $(this).closest('tr');
    var id = $(this).data("id");
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((isConfirm)=>{
        if (isConfirm) {
            $.ajax(
            {
                url: "deletePromises/"+id,
                type: 'GET',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response){
                    $tr.find('td').fadeOut(1000,function(){ 
                    $tr.remove();                    
                    }); 
                }
            });
            swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
            });
        } 
        }) 
});
</script>

<script type="text/javascript">
    $('.btnEdit').click(function(){
    
      var id = $(this).attr('id-detail');
    
      $.ajax({
        url: "/promises/edit/"+id,
        dataType:'json',
        method:'POST',
        data:{id2:id,"_token": "{{ csrf_token() }}"},
        success:function(data) {
        console.log(data);
        
        $('#id').val(data.id);
        $('#judul').val(data.judul);
        $('#periode').val(data.periode);
        $('#topik').val(data.topik);
        $('#status').val(data.status);
        $('#keterangan').val(data.keterangan);
        $('#tags').tagsinput('removeAll');
        $('#tags').tagsinput('add',data.tags);
        }
      });
    });
</script>
    
@endsection