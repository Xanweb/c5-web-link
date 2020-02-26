<?php
namespace Xanweb\WebLink;

use Concrete\Core\Foundation\Service\Provider as BaseServiceProvider;
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
        $this->app->call('director@addSubscriber', ['subscriber' => new WebLinkSubscriber()]);
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return ['web/link'];
    }
}
