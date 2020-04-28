@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alerta alert-info alert-dismissible d-flex flex-row">
    <i class="fas fa-fw fa-info-circle mr-3 mt-1"></i>
    <p>{{ $message }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div id='calendar'></div>


@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="{{ asset('/css/bootstrap-colorselector.min.css') }}">
<style>
    #content{
        background-color: #FFFFFF;
    }
    .active{
        background: #4e73df !important;
    }
    .fc-event {
    font-size: .75em;
    }
    .swal2-top-end {
      z-index: 2147483647 !important;
    }

</style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment-timezone/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/i18n/defaults-es_ES.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>
<script src="{{ asset('/js/bootstrap-colorselector.min.js') }}" ></script>
<script type="text/javascript">
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
$(document).ready(function() {
    $(".fc-toolbar .btn").removeClass("btn-primary");
    $(".fc-toolbar .btn").addClass("btn-outline-primary");
    $(".fc-toolbar .btn").addClass("btn-sm");
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        $(".fc table ").css("font-size", "0.85em");
        $('.fc-event').css('font-size', '0.85em');
        $('.fc-left').css('font-size', '0.75em');
        $(' div .fc-toolbar').addClass("row");
        $(' div .fc-toolbar').addClass("text-center");
        $(' div .fc-left').addClass("font-weight-bold");
        $(' div .fc-left').addClass("col-md-4");
        $(' div .fc-right').addClass("col-md-4");
        $(' div .fc-center').addClass("col-md-4");
        $(' div .fc-center').css('margin-top', '5px');
        $(' div .fc-center').css('margin-bottom', '10px');
    };

});
var SITEURL = "{{url('/')}}";
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [
            'interaction',
            'dayGrid',
            'bootstrap',
            'dayGrid',
            'timeGrid',
            'list',
            'moment'
        ],
        themeSystem: 'bootstrap',
        locale: 'es',
        columnHeaderFormat: {
            weekday: 'short',
            day: 'numeric',
            omitCommas: true
        },
        contentHeight:"auto",
        customButtons: {
            printButton: {
                text: 'Print',
                click: function() {
                    $("#calendar").print({
                        addGlobalStyles : true,
                        stylesheet : null,
                        rejectWindow : true,
                        noPrintSelector : ".no-print",
                        iframe : true,
                        append : 'null',
                        prepend : null
                    });
                }
            }
        },
        header: {
            left: 'title',
            center:'dayGridMonth,divdayGridMonth,timeGridFourDay,timeGridDay,listWeek',
            right: 'printButton prev,next today'
        },
        views: {
            timeGridFourDay: {
                type: 'timeGrid',
                duration: {
                    days: 4
                },
            },
            dayGridMonth: {
              selectable: false
            },
        },
        bootstrapFontAwesome: {
            printButton: 'fa-print',
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            today: 'fa-calendar-times',
            dayGridMonth: 'fa-calendar-alt',
            timeGridDay: 'fa-calendar-day',
            timeGridFourDay: 'fa-calendar-week',
            listWeek: 'fa-list-ul'
        },
        defaultView: 'timeGridFourDay',
        editable: true,
        timeZone: 'local',
        height: 800,
        nowIndicator: true,

        events: {!!$data!!},

        selectable: true,
        selectMirror: true,
        unselectAuto: false,
        selectOverlap: false,
        eventStartEditable: true,
        eventResizableFromStart:true,

        select(info) {
            $.confirm({
                title: 'Nueva Cita Médica',
                content: ''@include('events.partials.form'),
                type: 'blue',
                theme: 'bootstrap',
                columnClass: 'large',
                closeIcon: true,
                icon: 'fas fa-fw fa-calendar-alt',
                backgroundDismiss: 'Cancelar',
                escapeKey: 'Cancelar',
                content: function(){
                    var self = this;
                    self.setContent('' @include('events.partials.form'));
                    return $.ajax({
                        url: 'bower.json',
                        dataType: 'json',
                        method: 'get'
                    })
                },
                contentLoaded: function(data, status, xhr){
                    self.setContentAppend('<div>Content loaded!</div>');
                },
                onContentReady: function() {
                    $('#colorselector').colorselector();
                    change1 = 0;
                    change2 = 0;
                    change3 = 0;
                    $('select.patient_id').change(function() {
                        change1 = 1;
                        title = $(this).find(':selected').text();
                        patient_id = $(this).find(':selected').val();
                    });
                    $('select.setting_id').change(function() {
                        change2 = 1;
                        description = $(this).find(':selected').text();
                    });
                    $('select.colorselector').change(function() {
                        change3 = 1;
                        color = $(this).find(':selected').val();
                    });
                },
                buttons: {
                    formSubmit: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function() {
                            if (change1 == 0) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Selecciona un paciente'
                                })
                                return false;
                            }else if(change2 == 0){
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Selecciona una Clínica'
                                })
                                return false;
                            }else {
                                if(change3 == 0){
                                   color = '#3788D8';
                                }
                                var start = moment(info.startStr).format("Y-MM-DD HH:mm:ss");
                                var end = moment(info.endStr).format("Y-MM-DD HH:mm:ss");
                                $.ajax({
                                    url: SITEURL + "/events/create",
                                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&description=' + description + '&patient_id=' + patient_id + '&color=' + color,
                                    type: "POST",
                                    success: function(dato) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Cita creada con éxito'
                                        })

                                        calendar.addEvent({
                                            id: dato.id,
                                            color: color,
                                            title: title,
                                            description: description,
                                            start: start,
                                            end: end,
                                        });
                                        calendar.unselect()
                                    }
                                });
                            }
                        }
                    },
                    Cancelar: function() {
                        calendar.unselect();
                    },
                },
            });
        },

        eventDrop: function(info) {
            var title = info.event.title;
            var start = moment(info.event.start).format("Y-MM-DD HH:mm:ss");
            var end = moment(info.event.end).format("Y-MM-DD HH:mm:ss");
            var id = info.event.id;
            $.ajax({
                url: SITEURL + '/events/update',
                data: 'title=' + title + '&start=' + start + '&end=' + end + '&description=' + description + '&patient_id=' + patient_id + '&color=' + color,
                type: "POST",
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cita Actualizada con éxito'
                    })
                }
            });
        },

        eventResize: function(info) {
            var title = info.event.title;
            var start = moment(info.event.start).format("Y-MM-DD HH:mm:ss");
            var end = moment(info.event.end).format("Y-MM-DD HH:mm:ss");
            var id = info.event.id;
            $.ajax({
                url: SITEURL + '/events/update',
                data: 'title=' + title + '&start=' + start + '&end=' + end + '&id=' + id,
                type: "POST",
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Cita modificada con éxito',
                    })
                }
            });
        },

        eventClick: function(info) {
            $.confirm({
                title: '!Confirme esta acción!',
                content: "¿Realmente quiere eliminar esta cita?",
                type : 'red',
                theme: 'bootstrap',
                backgroundDismiss: 'no',
                escapeKey: 'no',
                icon: 'fas fa-fw fa-exclamation-circle',
                closeIcon: true,
                closeIconClass: 'fa fa-close',
                buttons: {
                    si: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/events/delete',
                                data: "&id=" + info.event.id,
                                success: function(response) {
                                    if (parseInt(response) > 0) {
                                        var event = calendar.getEventById(info.event.id);
                                        event.remove();
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Cita eliminada con éxito'
                                        })
                                    }
                                }
                            });
                        }
                    },
                    no: {
                        btnClass: 'btn-blue',
                        action: function() {}
                    },

                }
            });
        }

    });
    calendar.render();
});

$.fn.Reset_List_To_Default_Value = function() {
    $.each($(this), function(index, el) {
        var Founded = false;

        $(this).find('option').each(function(i, opt) {
            if (opt.defaultSelected) {
                opt.selected = true;
                Founded = true;
            }
        });

        if (!Founded) {
            if ($(this).attr('multiple')) {
                $(this).val([]);
            } else {
                $(this).val("");
            }
        }
        $(this).trigger('change');
    });
}
</script>
@endsection
