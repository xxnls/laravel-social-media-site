<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowProfileImage extends Component
{
    public $model;
    public $width;
    public $height;

    /**
     * Create a new component instance.
     */
    public function __construct($model, $width = 50, $height = 50)
    {
        $this->model = $model;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-profile-image');
    }
}
