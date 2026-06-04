<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Services\CriteriaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CriteriaController extends Controller
{
    public function __construct(
        protected CriteriaService $service
    ) {}

    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $perPage = (int) $request->input('per_page', 5);

        $criterias = $this->service->getAll($search, $perPage);

        return view('pages.criteria.criteria-management', [
            'criterias' => $criterias,
            'search' => $search,
            'per_page' => $perPage,
        ]);
    }

    public function store(StoreCriteriaRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function update(UpdateCriteriaRequest $request, int $id): RedirectResponse
    {
        // dd($id, $request->validated());
        $this->service->update($id, $request->validated());

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->service->delete($id);

        return redirect()
            ->route('admin.criteria.index')
            ->with('success', 'Data kriteria berhasil dihapus.');
    }
}