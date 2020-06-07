<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(Request $request)
    {
        return $this->categoryRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->categoryRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);
    }

    public function findAll(Request $request)
    {
        return $this->categoryRepository->findAll($request);
    }

    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function findByCategoryNameOrCreate(Request $request)
    {
        return $this->categoryRepository->findByCategoryNameOrCreate($request);
    }
}
