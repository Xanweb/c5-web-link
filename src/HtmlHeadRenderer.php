<?php
namespace Xanweb\WebLink;

use HtmlObject\Element;
use Psr\Link\LinkInterface;

final class HtmlHeadRenderer
{
    /**
     * Builds the value of the "Link" HTTP header.
     *
     * @param LinkInterface[]|\Traversable $links
     *
     * @return string|null
     */
    public function render(iterable $links): ?string
    {
        $elements = [];
        foreach ($links as $link) {
            if ($link->isTemplated()) {
                continue;
            }

            $elements[] = Element::create('link')
                ->setIsSelfClosing(true)
                ->setAttributes(array_merge([
                    'rel' => implode(' ', $link->getRels()),
                    'href' => $link->getHref(),
                ], $link->getAttributes()));
        }

        return $elements ? implode(PHP_EOL, $elements) : null;
    }
}
