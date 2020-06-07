<?php

namespace App\Services;

use App\Repositories\OrderItemRepository;
use Illuminate\Http\Request;

class OrderItemService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function findAll()
    {
        return $this->orderItemRepository->findAll();
    }

    public function findById($id)
    {
        return $this->orderItemRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->orderItemRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->orderItemRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->orderItemRepository->delete($id);
    }
}
