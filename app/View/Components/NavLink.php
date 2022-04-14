<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    public $href;
    public $controller;
    public $active;

    public function __construct($href, $controller)
    {
        $this->href = $href;
        $this->controller = $controller;

        $this->getActiveStatus();
    }

    private function getActiveStatus()
    {
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);

        switch($controller)
        {
            case 'HomeController':
                $this->active = ($controller == $this->controller) ? true : false;
                break;

            default:
                $this->active = false;
        }
    }

    public function render()
    {
        return view('components.nav-link');
    }
}
