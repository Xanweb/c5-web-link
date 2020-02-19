<?php
namespace Xanweb\WebLink;

use Concrete\Core\Application\Application;
use Concrete\Core\Foundation\Service\Provider as BaseServiceProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Xanweb\WebLink\Event\WebLinkSubscriber;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton([WebLink::class => 'web/link']);
        $this->registerListeners();
    }

    protected function registerListeners()
    {
        $this->app->extend(EventDispatcherInterface::class, function (EventDispatcherInterface $director, Application $app) {
            $director->addSubscriber($app->make(WebLinkSubscriber::class));

            return $director;
        });
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return ['web/link'];
    }
}
