@extends('layouts.master')

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('calendar/fonts/icomoon/style.css')}}">
    <link href="{{asset('calendar/fullcalendar/packages/core/main.css')}}" rel='stylesheet' />
    <link href="{{asset('calendar/fullcalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('calendar/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('calendar/css/style.css')}}">


  <div class="content">
    <div id='calendar'></div>
  </div><br>
  
  <!-- ForEventModal -->
  <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="event-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="margin: 0 auto;" id="event-modal-title"></h5>
        </div>
        <div class="modal-body text-justify" id="event-modal-body">
        </div>
        <div class="modal-footer" id="event-modal-footer">
          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
        </div>
      </div>
    </div>
  </div>
    
    

    <script src="{{asset('calendar/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('calendar/js/popper.min.js')}}"></script>
    <script src="{{asset('calendar/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('calendar/fullcalendar/packages/core/main.js')}}"></script>
    <script src="{{asset('calendar/fullcalendar/packages/interaction/main.js')}}"></script>
    <script src="{{asset('calendar/fullcalendar/packages/daygrid/main.js')}}"></script>
    <script>
    
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      defaultDate: '2023-04-05',
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        @foreach($events as $event)
        {
          
          title: '{{ $event->title }}',
          start: '{{$event->start_datetime}}',
          end: '{{$event->end_datetime}}',
          description: '{{$event->description}}',
          location: '{{$event->location}}',
          registrationLink: '{{ route('registrations.create', $event) }}',
          closeBtn: '',
        },
        @endforeach
      ],

//       events: () => {
//     return fetch('/event_calendar')
//         // .then(response => response.json())
//         .then(data => {
//             return data.map(event => {
//                 return {
//                     title: event.title,
//                     start: event.start_datetime,
//                     end: event.end_datetime,
//                     description: event.description,
//                     location: event.location,
//                     registrationLink: event.registrationLink,
//                 };
//             });
//         })
//         .catch(error => console.error(error));
// },

      
      eventDidMount: function(info) {
      var tooltip = new Tooltip(info.el, {
        title: info.event.extendedProps.description,
        placement: 'top',
        trigger: 'hover',
        container: 'body'
      });
    },
    eventClick: function(info) {
      var modal = new bootstrap.Modal(document.getElementById('event-modal'), {});
      var modalTitle = document.getElementById('event-modal-title');
      var modalBody = document.getElementById('event-modal-body');
      var modalFooter = document.getElementById('event-modal-footer');

      modalTitle.innerHTML = info.event.title;
      var startDate = info.event.start.toLocaleDateString();
      var endDate = info.event.end ? info.event.end.toLocaleDateString() : '';
      var dateRange = 'Event Schedule: '+`${startDate} - ${endDate}`;
      var location = '<i class="fa fa-map-marker"></i> '+info.event.extendedProps.location+'<br/>';
      var description ='<i class="fa">&#xf039;</i> ' +info.event.extendedProps.description+'<br/>';
      var registrationLink = info.event.extendedProps.registrationLink;
      var closeBtn = `<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>`;
      var content = `${dateRange}<br>${location}<br>${description}`;
      modalTitle.innerHTML = info.event.title;
      var footercontent = `${closeBtn}<a href="${registrationLink}" class="btn btn-primary" target="_blank">Register Now</a>`;
      modalBody.innerHTML = content;
      modalFooter.innerHTML = footercontent;
      modal.show();
    }

    });

    calendar.render();
    
  });

    </script>

    <script src="{{asset('calendar/js/main.js')}}"></script>
@endsection