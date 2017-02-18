$(function () {
    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next, prevYear, nextYear',
            center: 'title',
            right: 'month, basicWeek, basicDay,'
        },
        lazyFetching: true,
        firstDay: 1,
        timeFormat: {
            agenda: 'h:mmt',
            '': 'h:mmt'
        },
        eventSources: [
            {
                url: '../full-calendar/load',
                type: 'POST',
                data: {},
                error: function () {}
            }
        ]
    });
});
