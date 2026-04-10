<?php

namespace App\Livewire\Pages\Criteria;

use Livewire\Component;
use App\Models\Criteria;
use App\Livewire\Forms\CriteriaForm;

class Form extends Component
{
    public CriteriaForm $form;
    public ?int $id = null;

    public function mount($id = null)
    {
        if ($id) {
            $criteria = Criteria::findOrFail($id);
            $this->form->setCriteria($criteria);
        }
    }

    public function save()
    {
        $this->form->save();

        $this->dispatch('closeModal')->to('shared.global-modal');
        $this->dispatch('refreshCriteria')->to('pages.criteria-index.criteria-index');
    }

    public function render()
    {
        return view('livewire.pages.criteria.form-content');
    }
}