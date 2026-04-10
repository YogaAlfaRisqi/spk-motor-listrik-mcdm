<?php

namespace App\Livewire\Pages\CriteriaIndex;

use App\Models\Criteria;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\CriteriaForm;


class CriteriaIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public CriteriaForm $form;

    protected $listeners = ['refreshCriteria' => '$refresh'];

    public function create()
    {
        $this->form->reset();
        $this->form->setCriteria();

        $this->dispatch('openModal', [
            'title' => 'Create Criteria',
            'view' => 'livewire.criteria.form-content'
        ])->to('shared.global-modal');
    }

    public function edit(Criteria $criteria)
    {
        $this->form->setCriteria($criteria);

        $this->dispatch('openModal', [
            'title' => 'Edit Criteria',
            'view' => 'livewire.criteria.form-content'
        ])->to('shared.global-modal');
    }

    public function save()
    {
        $this->form->save();

        $this->dispatch('closeModal')->to('shared.global-modal');
        $this->dispatch('refreshCriteria');
    }

    public function delete(Criteria $criteria)
    {
        $criteria->delete();
    }

    public function render()
    {
        $criterias = Criteria::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(5);

        return view('livewire.pages.criteria.index', [
            'criterias' => $criterias
        ]);
    }
}
