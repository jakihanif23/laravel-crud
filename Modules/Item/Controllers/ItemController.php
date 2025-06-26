<?php

namespace Modules\Item\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Item\Actions\Delete;
use Modules\Item\Actions\Store;
use Modules\Item\Actions\Update;
use Modules\Item\Models\Item;
use Modules\Item\Requests\ItemRequest;

class ItemController extends Controller
{
    use ApiResponse;
    private array $relation = [];
    public function index(Request $request): JsonResponse
    {
        $model = Item::query()
            ->with($this->relation);

        $data = $this->search($model, $request);

        return $this->success($data);
    }
    public function store(ItemRequest $request): JsonResponse
    {
        $item = Store::run($request);

        return $this->success($item, 201, __('Item') . ' ' . __('Successfully') . ' ' . __('Created'));
    }

    public function show(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'BRG_')) {
            abort(400, 'Invalid Item code format.');
        }
        $id = (int) str_replace('BRG_', '', $kode);
        $item = Item::findOrFail($id );
        return $this->respondShow($item);
    }
    public function update(Request $request, string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'BRG_')) {
            abort(400, 'Invalid Item code format.');
        }
        $id = (int) str_replace('BRG_', '', $kode);
        $item = Update::run($request, $id);
        return $this->respondShow($item, 200, __('Item') . ' ' . __('Successfully') . ' ' . __('Updated'));
    }
    public function destroy(string $kode): JsonResponse
    {
        if (!str_starts_with($kode, 'BRG_')) {
            abort(400, 'Invalid Item code format.');
        }
        $id = (int) str_replace('BRG_', '', $kode);
        $deleted = Delete::run($id);

        return $this->respondShow($deleted,200, __('Item') . ' ' . __('Successfully') . ' '. __('Deleted'));
    }

    protected function search($query, Request $request)
    {
        $keyword = $request->input('search');
        $type = $request->input('searchType');

        if ($keyword) {
            $query->where(function ($q) use ($keyword, $type) {
                // Handle special "kode" search logic
                if ($type === 'kode' && str_starts_with($keyword, 'BRG_')) {
                    $id = (int) str_replace('BRG_', '', $keyword);
                    $q->orWhere('id', $id);
                } elseif (in_array($type, ['nama', 'kategori', 'harga'])) {
                    // Sanitize allowed columns
                    $q->orWhere($type, 'like', "%{$keyword}%");
                } else {
                    // Default: search all
                    $q->orWhere('nama', 'like', "%{$keyword}%")
                    ->orWhere('kategori', 'like', "%{$keyword}%")
                    ->orWhere('harga', 'like', "%{$keyword}%");
                }
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
