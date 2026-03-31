<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\AlternativeService;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    protected AlternativeService $alternative;
    public function __construct(AlternativeService $alternative)
    {
        $this->alternative = $alternative;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $alternatives = $this->alternative->getAllAlternatives();
        return response()->json([
            "status"=>"success",
            "data"=>$alternatives
        ]);

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
        $alternative = $this->alternative->getAlternativeById($id);
        if (!$alternative) {
            return response()->json([
                'status' => 'error',
                'message' => 'Alternative not found'
            ], 404);
        }
        return response()->json([
            "status"=>"success",
            "data"=>$alternative
        ]);
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
