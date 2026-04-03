<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;

class ModalForm extends Component
{
    // ─── State ────────────────────────────────────────────────────────────────
    public bool   $open      = false;
    public string $mode      = 'create';   // 'create' | 'edit' | 'delete'
    public string $title     = '';
    public string $size      = 'md';       // 'sm' | 'md' | 'lg' | 'xl' | 'full'
    public array  $fields    = [];
    public array  $formData  = [];
    public mixed  $recordId  = null;

    // ─── Listeners ────────────────────────────────────────────────────────────

    /**
     * Open the modal in CREATE mode.
     *
     * Dispatch from any component / JS:
     *   $dispatch('modal:open-create', { title: 'Add User', fields: [...] })
     */
    #[On('modal:open-create')]
    public function openCreate(string $title, array $fields, string $size = 'md'): void
    {
        $this->reset(['formData', 'recordId']);
        $this->mode   = 'create';
        $this->title  = $title;
        $this->size   = $size;
        $this->fields = $fields;

        // Pre-fill defaults
        foreach ($fields as $field) {
            $this->formData[$field['name']] = $field['default'] ?? '';
        }

        $this->open = true;
    }

    /**
     * Open the modal in EDIT mode.
     *
     * Dispatch:
     *   $dispatch('modal:open-edit', { title: '...', fields: [...], record: {...}, id: 5 })
     */
    #[On('modal:open-edit')]
    public function openEdit(string $title, array $fields, array $record, mixed $id, string $size = 'md'): void
    {
        $this->reset(['formData']);
        $this->mode     = 'edit';
        $this->title    = $title;
        $this->size     = $size;
        $this->fields   = $fields;
        $this->recordId = $id;

        // Hydrate form with existing record data
        foreach ($fields as $field) {
            $this->formData[$field['name']] = $record[$field['name']] ?? ($field['default'] ?? '');
        }

        $this->open = true;
    }

    /**
     * Open the modal in DELETE confirmation mode.
     *
     * Dispatch:
     *   $dispatch('modal:open-delete', { title: 'Delete User', id: 5, label: 'John Doe' })
     */
    #[On('modal:open-delete')]
    public function openDelete(string $title, mixed $id, string $label = '', string $size = 'sm'): void
    {
        $this->reset(['formData', 'fields']);
        $this->mode                = 'delete';
        $this->title               = $title;
        $this->size                = $size;
        $this->recordId            = $id;
        $this->formData['_label']  = $label;
        $this->open                = true;
    }

    // Close from outside
    #[On('modal:close')]
    public function closeModal(): void
    {
        $this->open = false;
    }

    // ─── Actions ──────────────────────────────────────────────────────────────

    public function close(): void
    {
        $this->open = false;
    }

    public function submit(): void
    {
        $this->validate($this->buildRules());

        match ($this->mode) {
            'create' => $this->dispatch('modal:submitted-create', data: $this->formData),
            'edit'   => $this->dispatch('modal:submitted-edit',   id: $this->recordId, data: $this->formData),
            default  => null,
        };

        $this->open = false;
    }

    public function confirmDelete(): void
    {
        $this->dispatch('modal:submitted-delete', id: $this->recordId);
        $this->open = false;
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function buildRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            if (!empty($field['rules'])) {
                $rules["formData.{$field['name']}"] = $field['rules'];
            }
        }
        return $rules;
    }

    // ─── Render ───────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.components.modal-form');
    }
}