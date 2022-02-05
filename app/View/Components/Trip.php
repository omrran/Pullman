<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Trip extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $id ,
                                public $from ,
                                public $to ,
                                public $numSeats ,
                                public $price ,
                                public $time ,
                                public $creationDate ,
                                public $companyName ,
                                public $companyImage ,
    )
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
        return view('components.trip');
    }
}
