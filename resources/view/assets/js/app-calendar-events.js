
document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    //var teste = JSON.parse(document.querySelector("#calendar").getAttribute("data-calendario"));
    const events = JSON.parse(document.querySelector("#calendar").getAttribute("data-calendario"));

    const calendarioData = JSON.parse('[{"id":"1","title":"Tess Infinity","start":"2023-05-23","end":"2023-05-23"}]');


    for (let i = 0; i < events.length; i++) {
        console.log(events[i].title);
        console.log(events[i].start);
        console.log(events[i].end);
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        plugins: ['interaction', 'dayGrid'],
        editable: true,
        eventLimit: true,
        events: events,
        extraParams: function () {
            return {
                cachebuster: new Date().valueOf()
            };
        }
    });

    calendar.render();
});
