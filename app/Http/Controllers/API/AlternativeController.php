<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlternativeRequest;
use App\Services\AlternativeService;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    protected $alternativeService;

    public function __construct(AlternativeService $alternativeService)
    {
        $this->alternativeService = $alternativeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->alternativeService->getAll();
        return ApiResponse::success($data, 'Alternatives list retrieved');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreAlternativeRequest $request)
    // {
    //     $data = $request->validated();

    //     $data['created_by'] = 1; // sementara (nanti pakai auth()->id())

    //     $alternative = $this->alternativeService->create($data);

    //     return ApiResponse::success($alternative, 'Alternative created', 201);
    // }
    public function store(StoreAlternativeRequest $request)
    {
        $validated = $request->validated();

        // Normalisasi: jika bukan batch, masukkan ke dalam array agar bisa di-loop
        $isBatch = isset($validated[0]);
        $items = $isBatch ? $validated : [$validated];

        $results = [];

        foreach ($items as $item) {
            $item['created_by'] = 1; // ID User sementara
            $results[] = $this->alternativeService->create($item);
        }

        // Kembalikan semua data yang berhasil dibuat atau hanya satu jika bukan batch
        $response = $isBatch ? $results : $results[0];

        return ApiResponse::success($response, 'Data berhasil diproses', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_motor)
    {
        //
        $data = $this->alternativeService->getById($id_motor);

        return ApiResponse::success($data, 'Alternative detail retrieved');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_motor)
    {
        //
        $data = $request->all();
        $alternative = $this->alternativeService->update($id_motor, $data);
        if (!$alternative) {
            return response()->json([
                'status' => 'error',
                'message' => 'Alternative not found'
            ], 404);
        }
        return response()->json([
            "status" => "success",
            "data" => $alternative
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_motor)
    {
        //
        $this->alternativeService->delete($id_motor);

        return ApiResponse::success(null, 'Alternative deleted');
    }
}
