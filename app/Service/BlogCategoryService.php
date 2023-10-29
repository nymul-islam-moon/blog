<?php

namespace App\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Interface\BlogCategoryInterface;
use Illuminate\Support\Facades\DB;


class BlogCategoryService implements BlogCategoryInterface
{
    public function all()
    {

        $blogCategories = BlogCategory::latest()->get();
        return $blogCategories;
    }

    public function store(array $formData)
    {
        $formData['created_by'] = auth()->user()->id;

        $formData['slug'] = Str::slug($formData['name'], '-');

        if ($formData['status'] == 1) {
            $formData['status'] = 1;
        }else {
            $formData['status'] = 0;
        }


        $productCategory = ProductCategory::create($formData);

        return $productCategory;
    }


    public function update($productCategory, array $formData)
    {
        $formData['updated_by_id'] = auth()->user()->id;

        $formData['slug'] = Str::slug($formData['name'], '-');


        if ($formData['status'] == 1) {
            $formData['status'] = 1;
        }else {
            $formData['status'] = 0;
        }

        $productCategory->update($formData);

        return $productCategory;

    }

}
