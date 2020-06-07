<?php

namespace App\Services;

use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;

class OrderStatusService
{
    protected $orderStatusRepository;

    public function __construct(OrderStatusRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function findAll()
    {
        return $this->orderStatusRepository->findAll();
    }

    public function findById($id)
    {
        return $this->orderStatusRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->orderStatusRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->orderStatusRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->orderStatusRepository->delete($id);
    }
}
