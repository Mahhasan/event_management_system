$(function() {

    fetch('/event_calendar')
    // .then(response => response.json())
    .then(data => {
        // use the data to populate your calendar
    })
    .catch(error => console.error(error));


});

