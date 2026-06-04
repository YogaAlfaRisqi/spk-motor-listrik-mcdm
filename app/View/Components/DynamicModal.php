<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicModal extends Component
{
    public $id;
    public $size;
    
    public function __construct($id = 'dynamicModal', $size = 'max-w-2xl')
    {
        $this->id = $id;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.dynamic-modal');
    }
}