<?php

namespace App\Livewire\Forms;

use App\Models\Criteria;
use Livewire\Form;

class CriteriaForm extends Form
{
    public ?Criteria $criteria = null;

    public string $name = '';
    public string $code = '';
    public string $type = '';
    public float $weight = 0;

    public function setCriteria(?Criteria $criteria = null)
    {
        $this->criteria = $criteria;

        if ($criteria) {
            $this->name = $criteria->name;
            $this->code = $criteria->code;
            $this->type = $criteria->type;
            $this->weight = $criteria->weight;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'code' => 'required|unique:criteria,code,' . ($this->criteria?->id ?? 'NULL'),
            'type' => 'required|in:benefit,cost',
            'weight' => 'required|numeric|min:0',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        Criteria::updateOrCreate(
            ['id' => $this->criteria?->id],
            $data
        );
    }
}