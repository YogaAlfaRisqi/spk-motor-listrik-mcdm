<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlternativeRequest;
use App\Services\AlternativeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlternativeController extends Controller
{
    public function __construct(
        protected AlternativeService $service
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //
        $search = $request->string('search')->toString();
        $perPage = (int) $request->input('per_page', 5);

        $alternatives = $this->service->getAll($search, $perPage);
        $title = 'Alternatives';
        return view('pages.alternatives.alternative-page', [
            'title' => $title,
            'alternatives' => $alternatives,
            'search' => $search,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlternativeRequest $request): RedirectResponse
    {
        //
        $this->service->store($request->validated() + ['foto' => $request->file('image')]);
        return redirect()->back()->with('success', 'Alternative added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAlternativeRequest $request, string $id)
    {
        //
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['foto'] = $request->file('image');
        }

        $this->service->update($id, $data);
        return redirect()->back()->with('success', 'Alternative updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->service->delete($id);
        return redirect()->back()->with('success', 'Alternative deleted successfully');
    }
}
