@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Artikel
        <small>JokowiMETER</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('artikel.list')}}"><i class="fa fa-newspaper-o"></i> Artikel</a></li>
        <li class="active">List</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Artikel Terkait Janji Jokowi</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">Judul</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">Foto</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Keterangan</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($artikels as $artikel)    
                            <tr role="row" class="odd">
                            <td data-id="{{$artikel->id}}" class="sorting_1">{{$artikel->judul}}</td>
                            <td data-id="{{$artikel->id}}">{{$artikel->foto}}</td>
                            <td data-id="{{$artikel->id}}"><button type="button" class="btn btn-xs {{( $artikel->keterangan == 'Draft') ? 'btn-danger' : 'btn-success'}}">{{( $artikel->keterangan == 'Draft') ? 'Draft' : 'Publish'}}</button></td>
                            <td data-id="{{$artikel->id}}">
                                <a class="btn btn-xs btn-default" id-detail="{{$artikel->id}}" data-toggle="modal" href='{{route('artikel.edit',$artikel->slug)}}'><i class="fa fa-edit"></i></a>
                                <a href="{{route('artikel.show',$artikel->slug)}}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                                <button class="delete btn btn-xs btn-danger" data-id="{{$artikel->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Judul</th>
                                <th rowspan="1" colspan="1">Foto</th>
                                <th rowspan="1" colspan="1">Keterangan</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('footer')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                url: "deleteArtikel/"+id,
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
@endsection