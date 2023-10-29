<?php

namespace App\Interface;

interface BlogCategoryInterface
{
    public function all();

    public function store(array $request);

    public function update($blogCategory, array $request);

}
