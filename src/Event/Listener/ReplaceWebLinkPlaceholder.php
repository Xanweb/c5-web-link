<?php
namespace Xanweb\WebLink\Event\Listener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Xanweb\WebLink\HtmlHeadRenderer;

class ReplaceWebLinkPlaceholder
{
    /**
     * Handle the event.
     *
     * @param  GenericEvent  $event
     */
    public function __invoke(GenericEvent $event)
    {
        $pageContent = $event->getArgument('contents');
        $pageContent = $this->processPlaceholderReplace($pageContent);

        $event->setArgument('contents', $pageContent);
    }

    protected function processPlaceholderReplace($contents)
    {
        $links = app('web/link')->getLinks();
        $output = count($links) ? (new HtmlHeadRenderer())->render($links) : '';

        return str_replace('<!--xw:web:link//-->', $output, $contents);
    }
}
