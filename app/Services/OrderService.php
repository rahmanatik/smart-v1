<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function findAll()
    {
        return $this->orderRepository->findAll();
    }

    public function findById($id)
    {
        return $this->orderRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->orderRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->orderRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->orderRepository->delete($id);
    }
}
