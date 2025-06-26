<?php

namespace Modules\Sale\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Sale\Actions\Delete;
use Modules\Sale\Actions\Store;
use Modules\Sale\Actions\Update;
use Modules\Sale\Models\Sale;
use Modules\Sale\Requests\SaleRequest;

class SaleController extends Controller
{
    use ApiResponse;
    private array $relation = ['customer', 'transactions.item'];

    public function index(Request $request): JsonResponse
    {
        $model = Sale::query()->with($this->relation);

        $data = $this->search($model, $request);

        return $this->success($data);
    }

    public function store(SaleRequest $request): JsonResponse
    {
        $sale = Store::run($request);
        $sale->load('customer');

        return $this->success($sale, 201, __('Sale') . ' ' . __('Successfully') . ' ' . __('Created'));
    }

    public function show(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'NOTA_')) {
            abort(400, 'Invalid Sale code format.');
        }

        $id = (int) str_replace('NOTA_', '', $kode);
        $sale = Sale::with($this->relation)->findOrFail($id);

        return $this->respondShow($sale);
    }

    public function update(Request $request, string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'NOTA_')) {
            abort(400, 'Invalid Sale code format.');
        }

        $id = (int) str_replace('NOTA_', '', $kode);
        $sale = Update::run($request, $id);
        $sale->load('customer');

        return $this->respondShow($sale, 200, __('Sale') . ' ' . __('Successfully') . ' ' . __('Updated'));
    }

    public function destroy(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'NOTA_')) {
            abort(400, 'Invalid Sale code format.');
        }

        $id = (int) str_replace('NOTA_', '', $kode);
        $deleted = Delete::run($id);

        return $this->respondShow($deleted, 200, __('Sale') . ' ' . __('Successfully') . ' ' . __('Deleted'));
    }

    protected function search($query, Request $request)
    {
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                if (str_starts_with($keyword, 'NOTA_')) {
                    $id = (int) str_replace('NOTA_', '', $keyword);
                    $q->orWhere('id', $id);
                }

                $q->orWhere('kode', 'like', "%{$keyword}%")
                  ->orWhereHas('customer', function ($sub) use ($keyword) {
                      $sub->where('nama', 'like', "%{$keyword}%");
                  });
            });
        }

        return $query->paginate(10);
    }
    protected function success($data, $code = 200, $message = 'Success'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
