<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Services\CriteriaService;
use Illuminate\Http\Request;

class RecomendationResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected CriteriaService $service
    ){}
    public function index()
    {
        //
        $criterias = $this->service->getAll();
        return view('pages.recomendation-result.recomendation-result-page', ['title' => 'Hasil Rekomendasi', 'criterias' => $criterias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
