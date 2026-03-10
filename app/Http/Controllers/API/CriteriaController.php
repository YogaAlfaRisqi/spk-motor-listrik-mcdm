<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Services\CriteriaService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;

class CriteriaController extends Controller
{
    protected $criteriaService;

    public function __construct(CriteriaService $criteriaService)
    {
        $this->criteriaService = $criteriaService;
    }

    public function index()
    {
        $data = $this->criteriaService->getAll();

        return ApiResponse::success($data, 'Criteria list retrieved');
    }

    public function show($id)
    {
        $data = $this->criteriaService->getById($id);

        return ApiResponse::success($data, 'Criteria detail retrieved');
    }

    public function store(StoreCriteriaRequest $request)
    {
        $data = $this->criteriaService->create($request->validated());

        return ApiResponse::success($data, 'Criteria created', 201);
    }

    public function update(UpdateCriteriaRequest $request, $id)
    {
        $data = $this->criteriaService->update($id, $request->validated());

        return ApiResponse::success($data, 'Criteria updated');
    }

    public function destroy($id)
    {
        $this->criteriaService->delete($id);

        return ApiResponse::success(null, 'Criteria deleted');
    }
}