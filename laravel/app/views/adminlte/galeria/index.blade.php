@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Galería :: @parent
@stop

@section('styles')
    <link href="{{asset('assets/css/dropzone.css')}}" rel="stylesheet" />
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Galería</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    {{ Form::open(array('action' => 'AdminGaleriaLTEController@upload', 'class'=>'dropzone', 'id'=>'my-dropzone')) }}
                    <!-- VISTA DE DROPBPX -->

                    @include('adminlte.include.dropbox')

                    <!-- ./ FIN DE VISTA DROPBOX -->

                    {{ Form::close() }}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>


@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.options.myDropzone = {

            acceptedFiles: ".jpeg,.jpg,.png",
            uploadMultiple: false,

            init: function() {

                var myDropzone = this;

                this.on("addedfile", function(file) {

                    var option = document.createElement("option");

                    var removeButton = Dropzone.createElement('<a class="dz-remove">Remove file</a>');

                    var _this = this;

                    removeButton.addEventListener("click", function(e) {

                        e.preventDefault();

                        e.stopPropagation();

                        var fileInfo = new Array();

                        fileInfo['name']=file.name;

                        $.ajax({

                            type: "POST",

                            url: "{{ URL::to('adminlte/galeria/delete-image') }}", // URL que que va al controlador que elimina la imagen

                            data: {_token : "{{ csrf_token() }}", file : file.name},

                            beforeSend: function () {


                                // before send


                            },

                            success: function (response) {

                                if (response == 'success')

                                    alert('deleted');

                            },


                            error: function () {

                                alert("error");

                            }

                        });

                        _this.removeFile(file);

                        // If you want to the delete the file on the server as well,


                        // you can do the AJAX request here.

                    });

                    // Add the button to the file preview element.

                    file.previewElement.appendChild(removeButton);

                });

                this.on('complete', function(file){
                    $("img:not(.img-responsive)").addClass('img-responsive');
                });

                $.each( Laracasts.files, function( key, value ) {

                    // Call the default addedfile event handler

                    myDropzone.emit("addedfile", value);

                    // And optionally show the thumbnail of the file:

                    myDropzone.emit("thumbnail", value, "{{url('/galeria/thumbnails/')}}/150x150_"+value.name);

                    myDropzone.emit("complete", value);

                });

            }
        };
    </script>
@stop