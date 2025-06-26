<?php

namespace Modules\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Customer\Actions\Delete;
use Modules\Customer\Actions\Store;
use Modules\Customer\Actions\Update;
use Modules\Customer\Models\Customer;
use Modules\Customer\Requests\CustomerRequest;

class CustomerController extends Controller
{
    use ApiResponse;
    private array $relation = [];
    public function index(Request $request): JsonResponse
    {
        $model = Customer::query()
            ->with($this->relation);

        $data = $this->search($model, $request);

        return $this->success($data);
    }
    public function store(CustomerRequest $request): JsonResponse
    {
        $customer = Store::run($request);

        return $this->success($customer, 201, __('Customer') . ' ' . __('Successfully') . ' ' . __('Created'));
    }

    public function show(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'PELANGGAN_')) {
            abort(400, 'Invalid customer code format.');
        }
        $id = (int) str_replace('PELANGGAN_', '', $kode);
        $customer = Customer::findOrFail($id );
        return $this->respondShow($customer);
    }
    public function update(Request $request, string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'PELANGGAN_')) {
            abort(400, 'Invalid customer code format.');
        }
        $id = (int) str_replace('PELANGGAN_', '', $kode);
        $customer = Update::run($request, $id);
        return $this->respondShow($customer, 200, __('Customer') . ' ' . __('Successfully') . ' ' . __('Updated'));
    }
    public function destroy(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'PELANGGAN_')) {
            abort(400, 'Invalid customer code format.');
        }
        $id = (int) str_replace('PELANGGAN_', '', $kode);
        $deleted = Delete::run($id);

        return $this->respondShow($deleted,200, __('Customer') . ' ' . __('Successfully') . ' '. __('Deleted'));
    }

    protected function search($query, Request $request)
    {
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                if (str_starts_with($keyword, 'PELANGGAN_')) {
                    $id = (int) str_replace('PELANGGAN_', '', $keyword);
                    $q->orWhere('id', $id);
                }

                $q->orWhere('nama', 'like', "%{$keyword}%")
                ->orWhere('domisili', 'like', "%{$keyword}%");
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
