<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'image' => $this->image,
            'created_by' => isset($this->created_by->id) ? $this->created_by->first_name . ' ' . $this->created_by->last_name : 'N/A',
            'updated_by' => isset($this->updated_by->id) ? $this->updated_by->first_name . ' ' . $this->updated_by->last_name : 'N/A',
        ];
    }
}
