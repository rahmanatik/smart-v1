<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ImageService
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function findAll()
    {
        return $this->imageRepository->findAll();
    }

    public function findById($id)
    {
        return $this->imageRepository->findById($id);
    }

    public function create(Request $request)
    {
        return $this->imageRepository->create($request);
    }

    public function update($id, Request $request)
    {
        $this->imageRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->imageRepository->delete($id);
    }
}
