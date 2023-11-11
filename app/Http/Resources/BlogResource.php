<?php

namespace App\Http\Resources;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_by_id' => $this->created_by_id ? User::where( 'id', $this->created_by_id )->first()->first_name . ' ' . User::where( 'id', $this->created_by_id )->first()->last_name : 'N/A',
            'blog_category_id' => $this->blog_category_id ?  BlogCategory::where( 'id', $this->blog_category_id )->first()->name : 'N/A',
            'title' => $this->title,
            'status' => $this->status,
            'image' => $this->image,
            'desc' => $this->desc,
        ];
    }
}
