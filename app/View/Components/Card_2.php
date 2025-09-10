<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $data;
    public $type;
    public $extra;

    public function __construct($data, $type = 'property', $extra = [])
    {
        $this->data  = $data;
        $this->type  = $type;
        $this->extra = $extra;
    }

    public function render()
    {
        return view('components.card');
    }
}
