@extends('dashboard.layout')
@section('content')
    <section class="content-header">
        <h1>
        Artikel
        <small>JokowiMETER</small>
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
                    <textarea id="isi" name="isi"></textarea>
                </div>
                <button type="submit" class="btn btn-primary col-lg-12">Save</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
</div>

 <!-- Modal -->
 <div id="myModal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <iframe id="iframe-pick" width="100%" height="450" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal -->
  <div id="myModal_video" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">video</h4>
        </div>
        <div class="modal-body">
          <iframe id="iframe-pick_video" width="100%" height="450" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>

    </div>
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
    $('#lfm').filemanager('file', {prefix: route_prefix});
</script>
<script src="{{asset('dashboard/bower_components/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('dashboard/bower_components/tinymce/jquery.tinymce.min.js')}}"></script>
 <!-- tinyMCE -->

<script>
  $(document).ready(function() {
  //tinyMCE
    tinymce.init({
      selector: 'textarea#isi',
      theme: 'modern',
      height: 400,
      plugins: [
        'advlist link image lists charmap print preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking medsos',
        'save table directionality emoticons template paste textcolor'
      ],
      toolbar: 'code insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fotoButton | videoButton | medsos',
      menubar: false,
      extended_valid_elements : "script[language|type|async|src|charset]",

      //custom button
      setup: function (editor) {
      //medsos
        editor.on('init', function (args) {
          editor_id = args.target.id;
        });
      //foto button
        editor.addButton('fotoButton', {
          text: 'TEMPO',
          icon: 'image',
          tooltip: 'Image from Newsroom',
            onclick: function () {
              gallerytinyMCE('foto');
            }
        });
      //video button
        editor.addButton('videoButton', {
          text: 'TEMPO',
          icon: 'media',
          tooltip: 'Video from Newsroom',
            onclick: function () {
              gallerytinyMCE('video');
            }
        });
      }
    });

    //modal utk tinyMCE
    function gallerytinyMCE(mod){
      if (mod == 'foto') {
        var src = 'http://newsroom.tmpo.co/ImagePicker?mod=tinyMCE';
        $('#iframe-pick').attr("src",src);
        $('#myModal').modal({show:true})
        $("#myModal").on('hide.bs.modal', function () {
          $('#iframe-pick').attr("src","");
        });
      }

      if (mod == 'video') {
        var src_video = 'http://newsroom.tmpo.co/VideoPicker?mod=tinyMCE_video';
        $('#iframe-pick_video').attr("src",src_video);
        $('#myModal_video').modal({show:true})
        $("#myModal_video").on('hide.bs.modal', function () {
          $('#iframe-pick_video').attr("src","");
        });
      }
    }
  })

    //populate dari modal forTinyMCE
    function forTinyMCE(string,id){
            var name=string
            var idfoto=id
            var deskripsi_foto
            var width = '720';
            if (idfoto < 650000) {
              width = '650';
            }

            $.ajax({
               url: "http://newsroom.tmpo.co/foto/getById/"+idfoto,
               success: function(data){
                console.log("deskripsi foto: "+data[0].deskripsi);
                var tgl_foto = data[0].tgl_foto.replace(/-/g,"/");
                var url = "https://cdn.tmpo.co/data/"+tgl_foto+"/id_"+idfoto+"/"+idfoto+"_720.jpg";
                var url2 = "https://cdn.tmpo.co/data/"+tgl_foto+"/id_"+idfoto+"/"+idfoto+"_650.jpg";
                var deskripsi_foto = data[0].deskripsi;
                if (idfoto > 650000) {
                  var foto = '<img width=\'100%\' src=\''+url+'\' ><small style="color:grey;font-style:italic;font-size:11px;line-height: 0em;">'+data[0].deskripsi+'</small>';
                }else{
                  var foto = '<img width=\'100%\' src=\''+url2+'\' ><small style="color:grey;font-style:italic;font-size:11px;line-height: 0em;">'+data[0].deskripsi+'</small>';
                }
                console.log("foto = "+foto);
                tinymce.activeEditor.execCommand('mceInsertContent', false, foto);

               },
                error: function() {
                   var foto = '<img width=\'100%\' src=\'https://statik.tempo.co/?id=' + idfoto + '&width='+width+'\' >';
                    console.log("foto = "+foto);
                    tinymce.activeEditor.execCommand('mceInsertContent', false, foto);
                }
            });
          }

          //populate dari modal forTinyMCE
          function forTinyMCE_video(string,id,id_video_brightcove){


            var name=string
            //var id_video_brightcove=id

            var gambar = '<iframe src="http://players.brightcove.net/3734026318001/BkT6OdRkX_default/index.html?videoId='+id_video_brightcove+'" allowfullscreen webkitallowfullscreen mozallowfullscreen width="500" height="360"></iframe>';

            tinymce.activeEditor.execCommand('mceInsertContent', false, gambar);
          }
</script>
<script type="text/javascript">
// tinymce.init({
//   selector: '#isi'
// });
</script>
{{-- <script>
    CKEDITOR.replace( 'isi', {
        height: 500,
        filebrowserImageBrowseUrl: route_prefix + '?type=Images',
        filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: route_prefix + '?type=Files',
        filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
</script> --}}
@endsection