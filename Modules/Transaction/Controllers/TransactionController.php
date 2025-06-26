<?php

namespace Modules\Transaction\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Transaction\Models\Transaction;
use Modules\Transaction\Requests\TransactionRequest;
use Modules\Transaction\Actions\Store;
use Modules\Transaction\Actions\Update;
use Modules\Transaction\Actions\Delete;

class TransactionController extends Controller
{
    use \App\Traits\ApiResponse;

    private array $relation = ['item', 'sale'];

    public function index(Request $request): JsonResponse
    {
        $query = Transaction::query()->with($this->relation);
        $data = $this->search($query, $request);
        return $this->success($data);
    }

    public function store(TransactionRequest $request): JsonResponse
    {
        $transaction = Store::run($request);
        $transaction->load($this->relation);

        return $this->respondShow($transaction, 201, __('Transaction') . ' ' . __('Successfully') . ' ' . __('Created'));
    }

    public function show(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'TRX_')) {
            abort(400, 'Invalid Transaction code format.');
        }

        $id = (int) str_replace('TRX_', '', $kode);
        $transaction = Transaction::with($this->relation)->findOrFail($id);

        return $this->respondShow($transaction);
    }

    public function update(Request $request, string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'TRX_')) {
            abort(400, 'Invalid Transaction code format.');
        }

        $id = (int) str_replace('TRX_', '', $kode);
        $transaction = Update::run($request, $id);
        $transaction->load($this->relation);

        return $this->respondShow($transaction, 200, __('Transaction') . ' ' . __('Successfully') . ' ' . __('Updated'));
    }

    public function destroy(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'TRX_')) {
            abort(400, 'Invalid Transaction code format.');
        }

        $id = (int) str_replace('TRX_', '', $kode);
        $deleted = Delete::run($id);

        return $this->respondShow($deleted, 200, __('Transaction') . ' ' . __('Successfully') . ' ' . __('Deleted'));
    }

    protected function search($query, Request $request)
    {
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                if (str_starts_with($keyword, 'TRX_')) {
                    $id = (int) str_replace('TRX_', '', $keyword);
                    $q->orWhere('id', $id);
                }

                $q->orWhereHas('item', function ($item) use ($keyword) {
                    $item->where('nama', 'like', "%{$keyword}%");
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
