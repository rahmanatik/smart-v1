<?php

namespace App\Services;

use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemService
{
    protected $itemRepository;
    protected $categoryService;
    protected $imageService;

    public function __construct(ItemRepository $itemRepository, CategoryService $categoryService, ImageService $imageService)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
    }

    //@Transactional
    public function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            if ($request->category_id == null)
                $request->category_id = $this->categoryService->findByCategoryNameOrCreate($request)->id;

            $itemId = $this->itemRepository->create($request);

            if ($request->image_url != null) {
                $request->item_id = $itemId;
                $this->imageService->create($request);
            }

            //throw new \Exception('Bad Reqest: category Name/Id missing');

            return $itemId;
        });
    }

    public function update($id, Request $request)
    {
        $this->itemRepository->update($id, $request);
    }

    public function delete($id)
    {
        $this->itemRepository->delete($id);
    }

    public function findAll()
    {
        return $this->itemRepository->findAll();
    }

    public function findById($id)
    {
        return $this->itemRepository->findById($id);
    }

    public function findAllDetails(Request $request)
    {
        return $this->itemRepository->findAllDetails($request);
        // return Item::all();
    }

    public function findDetailsById($id)
    {
        return $this->itemRepository->findDetailsById($id);
    }

    public function findDetailsByName($itemName)
    {
        return $this->itemRepository->findDetailsByName($itemName);
    }
}
