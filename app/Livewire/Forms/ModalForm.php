<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Modelable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DynamicCrudModal extends Component
{
    #[Modelable]
    public $show = false;

    public $mode = 'create'; // create, edit, view, delete
    public $title = '';
    public $modelClass = '';
    public $modelId = null;
    public $fields = [];
    public $data = [];
    public $validationRules = [];
    public $size = 'md'; // sm, md, lg, xl, 2xl, full
    
    protected $listeners = [
        'openModal' => 'open',
        'closeModal' => 'close'
    ];

    public function mount(
        string $modelClass = '',
        array $fields = [],
        array $validationRules = [],
        string $size = 'md'
    ) {
        $this->modelClass = $modelClass;
        $this->fields = $fields;
        $this->validationRules = $validationRules;
        $this->size = $size;
    }

    #[On('open-crud-modal')]
    public function open($params = [])
    {
        $this->mode = $params['mode'] ?? 'create';
        $this->modelId = $params['id'] ?? null;
        $this->title = $params['title'] ?? $this->getDefaultTitle();
        
        if ($this->mode === 'edit' || $this->mode === 'view' || $this->mode === 'delete') {
            $this->loadModel();
        } else {
            $this->resetData();
        }
        
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
        $this->reset(['data', 'mode', 'modelId']);
        $this->resetValidation();
    }

    protected function loadModel()
    {
        if ($this->modelId && $this->modelClass) {
            $model = $this->modelClass::find($this->modelId);
            
            if ($model) {
                foreach ($this->fields as $field) {
                    $fieldName = $field['name'];
                    $this->data[$fieldName] = $model->{$fieldName};
                }
            }
        }
    }

    protected function resetData()
    {
        $this->data = [];
        foreach ($this->fields as $field) {
            $this->data[$field['name']] = $field['default'] ?? '';
        }
    }

    public function save()
    {
        // Build dynamic validation rules
        $rules = [];
        foreach ($this->validationRules as $field => $rule) {
            $rules["data.{$field}"] = $rule;
        }
        
        $this->validate($rules);

        try {
            if ($this->mode === 'create') {
                $model = new $this->modelClass();
                foreach ($this->data as $key => $value) {
                    $model->{$key} = $value;
                }
                $model->save();
                
                $this->dispatch('crud-success', [
                    'message' => 'Data berhasil ditambahkan',
                    'type' => 'create'
                ]);
            } elseif ($this->mode === 'edit') {
                $model = $this->modelClass::find($this->modelId);
                foreach ($this->data as $key => $value) {
                    $model->{$key} = $value;
                }
                $model->save();
                
                $this->dispatch('crud-success', [
                    'message' => 'Data berhasil diupdate',
                    'type' => 'edit'
                ]);
            }

            $this->close();
            
        } catch (\Exception $e) {
            $this->dispatch('crud-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function delete()
    {
        try {
            $model = $this->modelClass::find($this->modelId);
            
            if ($model) {
                $model->delete();
                
                $this->dispatch('crud-success', [
                    'message' => 'Data berhasil dihapus',
                    'type' => 'delete'
                ]);
                
                $this->close();
            }
        } catch (\Exception $e) {
            $this->dispatch('crud-error', [
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    protected function getDefaultTitle()
    {
        return match($this->mode) {
            'create' => 'Tambah Data',
            'edit' => 'Edit Data',
            'view' => 'Detail Data',
            'delete' => 'Hapus Data',
            default => 'Data'
        };
    }

    public function getModalSize()
    {
        $sizes = [
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
            'full' => 'sm:max-w-full sm:m-4'
        ];
        
        return $sizes[$this->size] ?? $sizes['md'];
    }

    public function render()
    {
        return view('livewire.components.dynamic-crud-modal');
    }
}