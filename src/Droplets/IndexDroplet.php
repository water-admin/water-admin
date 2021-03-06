<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\TablePage;

class IndexDroplet extends Droplet
{
    public $methods = [
        'index',
    ];

    protected $pagination = true;

    public function index()
    {
        return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        $router->get('/', $this->water->action('index'));
    }
}
