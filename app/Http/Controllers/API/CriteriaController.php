<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CriteriaService;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
   
    protected CriteriaService $service;
    public function __construct(CriteriaService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $criteria = $this->service->getAllCriteria();
        return response()->json([
            "status"=>"success",
            "data"=>$criteria
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $criteria = $this->service->createCriteria($request->all());
        return response()->json([
                'status' => 'success',
                'message' => 'Criteria created successfully',
                'data' => $criteria
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $criteria = $this->service->getCriteriaById($id);
        if (!$criteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Criteria not found'
            ], 404);
        }
        return response()->json([
            "status"=>"success",
            "data"=>$criteria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $criteria = $this->service->updateCriteria($id, $request->all());
        if (!$criteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Criteria not found'
            ], 404);
        }
        return response()->json([
            "status"=>"success",
            "message"=>"Criteria updated successfully",
            "data"=>$criteria
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //'
        $deleted = $this->service->deleteCriteria($id);
        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Criteria not found'
            ], 404);
        }
        return response()->json([
            "status"=>"success",
            "message"=>"Criteria deleted (mock)",
            "id"=>$id
        ]);
    }
}
