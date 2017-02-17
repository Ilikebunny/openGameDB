<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AppBundle\Entity\EventCustom as MyCustomEvent;

class LoadDataListener {

    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return EventInterface[]
     */
    public function loadData(CalendarEvent $calendarEvent) {
        $startDate = $calendarEvent->getStart();
        $endDate = $calendarEvent->getEnd();
        $filters = $calendarEvent->getFilters();

        dump($startDate);
        //You may want do a custom query to populate the events

        $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
        $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));

        //You may want do a custom query to populate the events
        $start = new \DateTime('2017-02-17T17:30:00');
        $end = new \DateTime('2017-02-17T19:30:00');

        $event = new MyCustomEvent('Distribution salle blabla', $start);
        $event->setEndDate($end);
        $event->setAllDay(false);

        $calendarEvent->addEvent($event);
    }

}
