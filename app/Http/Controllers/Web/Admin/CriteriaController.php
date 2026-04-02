<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Services\CriteriaService;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function __construct(
        protected CriteriaService $service
    ){}

    public function index()
    {
        //
        $criterias = $this->service->getAll();
        $title = 'Criteria';
        return view('pages.criteria.criteria-management', compact('criterias','title'));
    }

     /**
     * Show form create
     */
    public function create()
    {
        $title = 'Tambah Kriteria';
        return view('admin.criterias.create', compact('title'));
    }

    /**
     * Store new data
     */
    public function store(StoreCriteriaRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Data kriteria berhasil ditambahkan');
    }

    /**
     * Show form edit
     */
    public function edit($id)
    {
        $criteria = $this->service->find($id);
        $title = 'Edit Kriteria';

        return view('admin.criterias.edit', compact('criteria', 'title'));
    }

    /**
     * Update data
     */
    public function update(UpdateCriteriaRequest $request, $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui');
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()
            ->back()
            ->with('success', 'Data kriteria berhasil dihapus');
    }
}


