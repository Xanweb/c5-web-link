<?php
namespace Xanweb\WebLink\Event\Listener;

use Symfony\Component\EventDispatcher\GenericEvent;

class MarkHeaderWebLinkPosition
{
    /**
     * Handle the event.
     *
     * @param  GenericEvent  $event
     */
    public function __invoke(GenericEvent $event)
    {
        $event->setArgument('linkTags', array_merge(
            $event->getArgument('linkTags'),
            ['<!--xw:web:link//-->']
        ));
    }
}
