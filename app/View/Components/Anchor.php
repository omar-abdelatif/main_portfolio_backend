<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Anchor extends Component
{

    public $route;
    public $params;
    public $icon;

    public function __construct($route, $icon, $params = null)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->params = $params;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anchor');
    }

    // Add this method to your Anchor component class
    public function generateRoute()
    {
        if (is_array($this->params)) {
            return route($this->route, $this->params);
        }

        return $this->params ? route($this->route, $this->params) : route($this->route);
    }
}
