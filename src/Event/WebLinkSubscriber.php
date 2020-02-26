<?php
namespace Xanweb\WebLink\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Xanweb\WebLink\HtmlHeadRenderer;

class WebLinkSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'on_header_required_ready' => [
                ['markHeaderWebLinkPosition'],
            ],
            'on_page_output' => [
                ['replaceWebLinkPlaceholder'],
            ],
        ];
    }

    /**
     * @param  GenericEvent  $event
     */
    public function markHeaderWebLinkPosition(GenericEvent $event)
    {
        $event->setArgument('linkTags', array_merge(
            $event->getArgument('linkTags'),
            ['<!--xw:web:link//-->']
        ));
    }

    /**
     * @param  GenericEvent  $event
     */
    public function replaceWebLinkPlaceholder(GenericEvent $event)
    {
        $pageContent = $event->getArgument('contents');
        $pageContent = $this->processPlaceholderReplace($pageContent);

        $event->setArgument('contents', $pageContent);
    }

    private function processPlaceholderReplace($contents)
    {
        $links = app('web/link')->getLinks();
        $output = count($links) ? (new HtmlHeadRenderer())->render($links) : '';

        return str_replace('<!--xw:web:link//-->', $output, $contents);
    }
}
