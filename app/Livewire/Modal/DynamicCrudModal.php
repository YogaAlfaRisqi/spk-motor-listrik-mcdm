<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Modelable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class GlobalCrudModal extends Component
{
    public $show = false;

    public $mode;
    public $title;

    public $modelClass;
    public $modelId;

    public $fields = [];
    public $rules = [];
    public $data = [];

    #[On('open-crud-modal')]
    public function open($config)
    {
        $this->reset();

        $this->mode = $config['mode'];
        $this->title = $config['title'] ?? $this->defaultTitle();
        $this->modelClass = $config['model'];
        $this->modelId = $config['id'] ?? null;
        $this->fields = $config['fields'] ?? [];
        $this->rules = $config['rules'] ?? [];

        if (in_array($this->mode, ['edit', 'view', 'delete'])) {
            $this->loadData();
        } else {
            $this->initEmpty();
        }

        $this->show = true;
    }

    public function close()
    {
        $this->reset();
    }

    protected function loadData()
    {
        $model = $this->modelClass::findOrFail($this->modelId);

        foreach ($this->fields as $field) {
            $this->data[$field['name']] = $model->{$field['name']};
        }
    }

    protected function initEmpty()
    {
        foreach ($this->fields as $field) {
            $this->data[$field['name']] = $field['default'] ?? '';
        }
    }

    public function save()
    {
        $rules = collect($this->rules)
            ->mapWithKeys(fn($r, $f) => ["data.$f" => $r])
            ->toArray();

        $this->validate($rules);

        $model = $this->mode === 'edit'
            ? $this->modelClass::findOrFail($this->modelId)
            : new $this->modelClass();

        foreach ($this->data as $key => $value) {
            if (in_array($key, $model->getFillable())) {
                $model->{$key} = $value;
            }
        }

        $model->save();

        $this->dispatch('crud-success');
        $this->close();
    }

    public function delete()
    {
        $model = $this->modelClass::findOrFail($this->modelId);
        $model->delete();

        $this->dispatch('crud-success');
        $this->close();
    }

    protected function defaultTitle()
    {
        return match($this->mode) {
            'create' => 'Tambah Data',
            'edit' => 'Edit Data',
            'view' => 'Detail Data',
            'delete' => 'Hapus Data',
        };
    }

    public function render()
    {
        return view('livewire.components.global-crud-modal');
    }
}
