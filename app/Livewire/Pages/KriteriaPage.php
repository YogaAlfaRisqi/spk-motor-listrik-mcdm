<?php
namespace App\Livewire\Pages;

use App\Models\Criteria;
use App\Models\Kriteria;
use Livewire\Component;

class KriteriaPage extends Component
{
    public $criterias = [];

    // ✅ DEFINE DI SINI
    public $fields = [];
    public $validationRules = [];

    protected $listeners = ['refresh-table' => 'loadData'];

    public function mount()
    {
        $this->loadData();

        // ✅ INIT FIELDS
        $this->fields = [
            [
                'name' => 'kode_kriteria',
                'label' => 'Kode',
                'type' => 'text'
            ],
            [
                'name' => 'nama_kriteria',
                'label' => 'Nama',
                'type' => 'text'
            ],
            [
                'name' => 'skala_penilaian',
                'label' => 'Satuan',
                'type' => 'text'
            ],
            [
                'name' => 'tipe',
                'label' => 'Tipe',
                'type' => 'select',
                'options' => ['benefit', 'cost']
            ],
        ];

        // ✅ INIT VALIDATION
        $this->validationRules = [
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'skala_penilaian' => 'nullable',
            'tipe' => 'required|in:benefit,cost',
        ];
    }

    public function loadData()
    {
        $this->criterias = Criteria::latest()->get();
    }

    public function create()
    {
        $this->dispatch('openModal', [
            'mode' => 'create',
            'title' => 'Tambah Kriteria'
        ]);
    }

    public function edit($id)
    {
        $this->dispatch('openModal', [
            'mode' => 'edit',
            'id' => $id,
            'title' => 'Edit Kriteria'
        ]);
    }

    public function delete($id)
    {
        $this->dispatch('openModal', [
            'mode' => 'delete',
            'id' => $id,
            'title' => 'Hapus Kriteria'
        ]);
    }

    public function render()
    {
        return view('livewire.pages.criteria-page');
    }
}