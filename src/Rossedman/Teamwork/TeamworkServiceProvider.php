<?php namespace Poprigun\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['rossedman.teamwork'] = $this->app->share(function($app)
        {
            $client = new \Poprigun\Teamwork\Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new \Poprigun\Teamwork\Factory($client);
        });

        $this->app->bind('Poprigun\Teamwork\Factory', 'rossedman.teamwork');
    }

}
