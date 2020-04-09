@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success alerta" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif

<div class="row">
    @if ($message = Session::get('info'))
        <div class="alert alerta alert-info alert-dismissible d-flex flex-row">
            <i class="fas fa-fw fa-info-circle mr-3 mt-1"></i>
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="col-xl-4">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body" style="margin-top:-10px">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-calendar-plus"></i> Calendario de Citas</h1>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body" style="margin-top:-10px">
            
                <div id='calendar'></div>
              
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.css" />
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css" />
<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            header: {
                center: 'dayGridMonth,timeGridFourDay,timeGrid' // buttons for switching between views
            },
            plugins: [ 'interaction', 'dayGrid','bootstrap','timeGrid' ],
            defaultView: 'timeGridWeek',
            views: {
                timeGridFourDay: {
                  type: 'timeGrid',
                  duration: { days: 4 },
                  buttonText: '4 Días'
                },
                timeGrid: {
                  buttonText: 'Citas hoy',
                }
            },
            locale: 'es',
            themeSystem: 'bootstrap',
            selectable: true,
            dateClick: function(info) {
            alert('Clicked on: ' + info.dateStr);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('Current view: ' + info.view.type);
            // change the day's background color just for fun
            info.dayEl.style.backgroundColor = 'red';
  },
            eventSources: [
                {
                  events: [ // put the array in the `events` property
                    {
                      title  : 'event1',
                      start  : '2020-04-01'
                    },
                    {
                      title  : 'event2',
                      start  : '2020-04-05',
                      end    : '2020-04-07'
                    },
                    {
                      title  : 'event3',
                      start  : '2020-04-09T12:30:00',
                    }
                  ],
                  
                }

                // any other event sources...

              ]
        });

        calendar.render();
        });

    </script>
@endsection
