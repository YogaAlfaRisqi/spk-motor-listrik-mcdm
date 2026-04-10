<?php

namespace App\Livewire;

use Livewire\Component;

class GlobalModal extends Component
{
    public $show = false;
    public $component = '';
    public $componentParams = [];
    public $title = '';
    public $size = 'md'; // sm, md, lg, xl, full
    public $showHeader = true;
    public $showFooter = false;
    public $closeOnClickOutside = true;
    public $closeOnEscape = true;

    protected $listeners = [
        'openModal',
        'closeModal',
        'updateModalTitle',
    ];

    public function openModal($component, $params = [], $options = [])
    {
        $this->component = $component;
        $this->componentParams = $params;
        
        // Set options
        $this->title = $options['title'] ?? '';
        $this->size = $options['size'] ?? 'md';
        $this->showHeader = $options['showHeader'] ?? true;
        $this->showFooter = $options['showFooter'] ?? false;
        $this->closeOnClickOutside = $options['closeOnClickOutside'] ?? true;
        $this->closeOnEscape = $options['closeOnEscape'] ?? true;
        
        $this->show = true;
        
        // Reset scroll
        $this->dispatch('modal-opened');
    }

    public function closeModal()
    {
        $this->show = false;
        $this->component = '';
        $this->componentParams = [];
        $this->title = '';
        
        $this->dispatch('modal-closed');
    }

    public function updateModalTitle($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.global-modal');
    }
}