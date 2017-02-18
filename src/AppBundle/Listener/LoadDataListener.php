<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AppBundle\Entity\EventCustom as MyCustomEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadDataListener {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return EventInterface[]
     */
    public function loadData(CalendarEvent $calendarEvent) {
        $startDate = $calendarEvent->getStart();
        $endDate = $calendarEvent->getEnd();
        $filters = $calendarEvent->getFilters();

        $em = $this->container->get('doctrine')->getEntityManager('default');
        $queryBuilder = $em->getRepository('AppBundle:Game')
                ->getBetweenRelease($startDate, $endDate);
        $result = $queryBuilder->getQuery()->getResult();

        foreach ($result as $game) {
            $name = $game->getTitle() . ' (' . $game->getPlatform()->getName() . ')';
            $event = new MyCustomEvent($name, $game->getReleaseDate());

            $url = $this->container->get('router')->generate(
                    'game_show', array('id' => $game->getId())
            );

            $event->setUrl($url);
            
            $calendarEvent->addEvent($event);
        }
    }

}
