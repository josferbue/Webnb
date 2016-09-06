@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('styles')
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">

    <style rel="stylesheet">
        .fc-time{
            display: none !important;
        }

        .fc-title{
            font-size: 1.3em !important;
        }

        .external-event{
            width: auto !important;
        }
    </style>
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-3">

                    <!-- CONTROLES DEL CALENDARIO -->

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Eventos Disponibles</h4>
                        </div>
                        <div class="box-body">
                            <!-- the events -->
                            <div id="external-events">
                            {{--*/

                                $eventos_disponibles = EventoDisponible::orderBy('titulo')->get()


                                /*--}}

                            @foreach($eventos_disponibles as $evento)
                                    <div data-evento="{{ $evento->id }}" style="background: {{ $evento->color }}; color: #fff;" class="external-event ui-draggable ui-draggable-handle">{{ $evento->titulo }}</div>
                            @endforeach

                                <div class="checkbox">
                                    <label for="drop-remove">
                                        <input id="drop-remove" type="checkbox">
                                        Eliminar después de soltar.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Crear Evento</h3>
                        </div>
                        <div class="box-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" class="form-control" placeholder="Título del Evento" type="text">

                                <div class="input-group-btn">
                                    <button style="background-color: rgb(0, 192, 239); border-color: rgb(0, 192, 239);" id="add-new-event" type="button" class="btn btn-primary btn-flat">Añadir</button>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Eliminar Evento</h3>
                        </div>
                        <div class="box-body">
                            <div id="contenedor_papelera" style="position: relative;">
                                <img src="{{ URL::asset('template/adminLTE/dist/img/custom/papel.png') }}" class="img-responsive">
                            </div>
                        </div>
                    </div>

                    <!-- /FIN DE CONTROLES DEL CALENDARIO -->

                </div>
                <div class="col-md-9">

                    <div class="box box-danger">
                        <div class="box-body">

                            <!-- CALENDARIO DE EVENTOS -->

                            <div class="fc fc-ltr fc-unthemed" id="calendar"></div>

                            <!-- /FIN DE CALENDARIOS DEL CALENDARIO -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

{{-- Scripts --}}
@section('scripts')
    <!-- Moment 2.11.2 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- fullCalendar 2.2.5 -->

    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script type="text/javascript" src='{{ URL::asset('template/adminLTE/plugins/fullcalendar/lang/es.js') }}'></script>


    <!-- Initialize -->
    <script type="text/javascript">

        function eliminarEventoDisponible(oEvento){

            //Guardar ID Del Evento

            var idEvento = oEvento.context.dataset.evento;

            //Eliminar Evento De la Vista

            oEvento.remove();

            //Eliminar Evento De la Tabla

            var jqAjax = $.ajax({
                url: '{{ URL::to('adminlte/eventos-disponibles/delete') }}',
                type: 'POST',
                async: true,
                data: 'evento='+idEvento,
                dataType: 'json'
            }).always(function(){
                if(jqAjax.responseText == 'success'){
                    console.log('success');
                }
                else if(jqAjax.responseText == 'error'){
                    console.log('error-controlado');
                }
                else{
                    console.log('error-no-controlado');
                }
            });
        }

        function EliminarEvento(idEvento){

            var jqAjax = $.ajax({
                url: '{{ URL::to('adminlte/eventos/delete') }}',
                type: 'POST',
                async: true,
                data: { _token : "{{ csrf_token() }}", evento : idEvento },
                dataType: 'json'
            }).always(function(){
                if(jqAjax.responseText == 'success'){
                    console.log('success');
                }
                else if(jqAjax.responseText == 'error'){
                    console.log('error-controlado');
                }
                else{
                    console.log('error-no-controlado');
                }
            });

        }

        function guardarEvento(oEvento){

            var dStart = new Date(oEvento.start._d);
            var iDiaStart   = dStart.getDate();
            var iMesStart   = dStart.getMonth() + 1;
            var iAnyoStart  = dStart.getFullYear();

            var dFin   = new Date(dStart.getTime() + 86400000);

            var sStart = iAnyoStart+'-'+iMesStart+'-'+iDiaStart;
            var sFin   = dFin.getFullYear()+'-'+(dFin.getMonth() + 1)+'-'+dFin.getDate();

            var sTitulo         = oEvento.title;
            var sFechaIni       = sStart;
            var sFechaFin       = sFin;
            var sColor          = oEvento.backgroundColor;

            var oEventoSend = { titulo : sTitulo, fecha_ini : sFechaIni, fecha_fin : sFechaFin, color : sColor };

            jqAjax = $.ajax({
                url: '{{ URL::to('adminlte/eventos/save') }}',
                type: 'POST',
                async: true,
                data: { _token : "{{ csrf_token() }}", evento : JSON.stringify(oEventoSend) },
                dataType: 'json'
            }).always(function(data){

                oEvento.id = data;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)

                $('#calendar').fullCalendar('renderEvent', oEvento, true);

            });
        }

        $(function(){
            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function(){

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });
            }

            ini_events($('#external-events div.external-event'));

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear();

            //Database Events

            var oEventos                =   {{ $eventos }};
            var oEventosForCalendar     =   new Array();

            $(oEventos).each(function(){
                var oEventoForCalendar  =   {
                    id:                 $(this).get(0).id,
                    title:              $(this).get(0).titulo,
                    start:              new Date($(this).get(0).fecha_inicio),
                    end:                new Date($(this).get(0).fecha_fin),
                    backgroundColor:    $(this).get(0).color,
                    borderColor:        $(this).get(0).color,
                    allDay :            true
                };

                oEventosForCalendar.push(oEventoForCalendar);
            });



            $('#calendar').fullCalendar({
                lang: 'es',
                header: {
                    left: 'prev,next',
                    center: 'title'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },

                events: oEventosForCalendar,

                eventDragStop: function(event, jsEvent, ui, view){

                    var trashEl = $('#contenedor_papelera');
                    var calendario = $('.fc-day-grid-container');

                    var ofs = trashEl.offset();
                    var ofs2 = calendario.offset();

                    var x1 = ofs.left;
                    var x2 = ofs.left + trashEl.outerWidth(true);
                    var y1 = ofs.top;
                    var y2 = ofs.top + trashEl.outerHeight(true);

                    var a1 = ofs2.left;
                    var a2 = ofs2.left + calendario.outerWidth(true);
                    var b1 = ofs2.top;
                    var b2 = ofs2.top + calendario.outerHeight(true);

                    if(jsEvent.pageX >= x1 && jsEvent.pageX<= x2 && jsEvent.pageY>= y1 && jsEvent.pageY <= y2){

                        //Eliminar evento de la base de datos.

                        EliminarEvento(event.id);

                        $('#calendar').fullCalendar('removeEvents', event.id);
                    }
                },

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay){ // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("background-color");

                    //Guardar Evento en base de datos

                    guardarEvento(copiedEventObject);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')){

                        // if so, remove the element from the "Draggable Events" list

                        eliminarEventoDisponible($(this));

                    }

                },
                eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc){

                    var dStart = new Date(event.start._d);
                    var iDiaStart   = dStart.getDate();
                    var iMesStart   = dStart.getMonth() + 1;
                    var iAnyoStart  = dStart.getFullYear();

                    //La fecha fin se construye +1 day si es null, si no se coge la que tiene

                    if(event.end !== null)
                        var dFin   = new Date(event.end._d);
                    else
                        var dFin   = new Date(dStart.getTime() + 86400000);

                    var sStart = iAnyoStart+'-'+iMesStart+'-'+iDiaStart;
                    var sFin   = dFin.getFullYear()+'-'+(dFin.getMonth() + 1)+'-'+dFin.getDate();


                    var oEventoSend = { id : event._id, fecha_ini : sStart, fecha_fin : sFin };
                    var sEventoSend = JSON.stringify(oEventoSend);


                    jqAjax = $.ajax({
                        url: '{{ URL::to('adminlte/eventos/update') }}',
                        type: 'POST',
                        async: true,
                        data: { _token : "{{ csrf_token() }}", evento : sEventoSend },
                        dataType: 'json'
                    }).always(function(data){

                    });
                },
                eventResize: function(event, delta, revertFunc) {

                    var dStart = new Date(event.start._d);
                    var iDiaStart   = dStart.getDate();
                    var iMesStart   = dStart.getMonth() + 1;
                    var iAnyoStart  = dStart.getFullYear();

                    var dFin = new Date(event.end._d);

                    var sStart = iAnyoStart+'-'+iMesStart+'-'+iDiaStart;
                    var sFin   = dFin.getFullYear()+'-'+(dFin.getMonth() + 1)+'-'+dFin.getDate();

                    var oEventoSend = { id : event._id, fecha_ini : sStart, fecha_fin : sFin };
                    var sEventoSend = JSON.stringify(oEventoSend);

                    jqAjax = $.ajax({
                        url: '{{ URL::to('adminlte/eventos/update') }}',
                        type: 'POST',
                        async: true,
                        data: { _token : "{{ csrf_token() }}", evento : sEventoSend },
                        dataType: 'json'
                    }).always(function(data){

                    });
                },
                eventClick: function( event, jsEvent, view ){

                    jqAjax = $.ajax({
                        url: '{{ URL::to('adminlte/eventos/url') }}',
                        type: 'GET',
                        async: true,
                        data: { id : event._id },
                        dataType: 'text'
                    }).always(function(res){

                        $.colorbox({
                            iframe: true,
                            width:'80%',
                            height:'80%',
                            maxWidth:'80%',
                            maxHeight:'80%',
                            overlayClose: false,
                            onLoad: function(){
                                $('#cboxClose').remove();
                                $.colorbox.resize();
                            },
                            href: res
                        });

                    });

                }
            });

            /* ELIMINAR EVENTOS */

            $("#contenedor_papelera").droppable({
                drop: function(event, ui){

                    ui.draggable.appendTo($(this)).css({position: 'absolute', top : '50%', left: ''}).delay(500).fadeOut(500, 'linear', function(){

                        eliminarEventoDisponible($(this));

                    });
                }
            });

            /* ADDING EVENTS */
            var currColor = "#3c8dbc"; //Red by default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function (e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css("color");
                //Add color effect to button
                $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
            });
            $("#add-new-event").click(function (e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $("#new-event").val();
                if (val.length == 0) {
                    return;
                }

                //Guardar Evento En Base De Datos
                var jqAjax = $.ajax({
                    url: '{{ URL::to('adminlte/eventos-disponibles/save') }}',
                    type: 'POST',
                    async: true,
                    data: 'evento='+val+'&color='+currColor,
                    dataType: 'json'
                }).always(function(){
                    if(JSON.parse(jqAjax.responseText)[0] == 'success'){

                        //Create events
                        var event = $("<div />");
                        event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
                        event.html(val);
                        event.get(0).dataset.evento = JSON.parse(jqAjax.responseText)[1];
                        $('#external-events').prepend(event);

                        //Add draggable funtionality
                        ini_events(event);

                    }
                    else if(jqAjax.responseText == 'error'){
                        console.log('error-controlado');
                    }
                    else{
                        console.log('error-no-controlado');
                    }
                });

                //Remove event from text input
                $("#new-event").val("");
            });

        });
    </script>
@stop