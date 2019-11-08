@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Master Data
        <small>JokowiMETER</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{route('jm.index')}}"><i class="fa fa-tasks"></i> Master Data</a></li>
        <li class="active">Periode</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Periode</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive col-lg-6">
                    <table id="periode" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Periode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode as $item)    
                            <tr>
                                <td data-id="{{$item->id}}">{{$item->nama}}</td>
                                <td><button type="button" class="btn btn-sm btn-default" data-id="{{$item->id}}" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Delete" onclick="hapus(this)"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                        
                <div class="col-lg-6">
                <form id="myForm">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tambah</label>
                        <div class="col-sm-10">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Periode" required><br>
                            <button id="submited" name="submited" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('footer')
<script>
    jQuery(document).ready(function(){
        jQuery('#submited').click(function(e){
            e.preventDefault();
            jQuery.ajax({
                url: "{{ url('periode') }}",
                method: 'post',
                data: {
                name: jQuery('#nama').val(),
                _token: '{{csrf_token()}}'
                },
                success: function(data){
                    $('#periode').append('<tr><td data-id="'+data.idB+'">'+data.namaB+'</td><td><button type="button" class="btn btn-sm btn-default" data-id="'+data.idB+'" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Delete" onclick="hapus(this)"><i class="fa fa-trash-o"></i></button></td></tr>');
                    jQuery('#nama').val('');
                }});
            });
        });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function hapus(ini){
    var $tr = $(ini).closest('tr');
    var id = $(ini).data("id");
    console.log(id);
    
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
                url: "/deletePeriode/"+id,
                type: 'DELETE',
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
};
</script>
@endsection