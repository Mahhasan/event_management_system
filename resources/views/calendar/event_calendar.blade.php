<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <title>Custom Event Calendar</title>
  </head>
  <body>
  
<h1>{{$registration->name}}</h1>
  <div class="content">
    <div id='calendar'></div>
  </div><br>
  

 
  


  <!-- ForEventModal -->
  <div class="modal fade text-center" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="event-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="event-modal-title"></h5>
        </div>
        <div class="modal-body" id="event-modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
        {
          
          title: 'bbb',
          start: '2023-04-10',
          end: '2023-04-12',
          description: 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',
          location: 'Dhaka',
          registrationLink: 'abc.com',
        },
      ],
      
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

      modalTitle.innerHTML = info.event.title;
      var startDate = info.event.start.toLocaleDateString();
      var endDate = info.event.end ? info.event.end.toLocaleDateString() : '';
      var dateRange = 'Event Schedule: '+`${startDate} - ${endDate}`;
      var location = '<i class="fa fa-map-marker"></i> '+info.event.extendedProps.location+'<br/>';
      var description ='<i class="fa">&#xf039;</i> ' +info.event.extendedProps.description+'<br/>';
      var registrationLink = info.event.extendedProps.registrationLink;
      var content = `${dateRange}<br>${location}<br>${description}<br><a href="${registrationLink}" class="btn btn-primary" target="_blank">Register Now</a>`;

      modalBody.innerHTML = content;
      modal.show();
    }

    });

    calendar.render();
    
  });

    </script>

    <script src="js/main.js"></script>
  </body>
</html>