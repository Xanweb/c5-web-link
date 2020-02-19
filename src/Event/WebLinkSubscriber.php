<?php
namespace Xanweb\WebLink\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WebLinkSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'on_header_required_ready' => new Listener\MarkHeaderWebLinkPosition(),
            'on_page_output' => new Listener\ReplaceWebLinkPlaceholder(),
        ];
    }
}
