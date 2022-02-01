<?php

namespace App\View\Components;

use Illuminate\View\Component;

class company extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $photo ,public $name ,public $address,public $telephone)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.company');
    }
}
