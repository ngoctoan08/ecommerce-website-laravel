<?php

namespace App\Http\Resources\Api\v1;

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
            'data' => parent::toArray($request),
            // 'pagination' => [
            //     "current_page" => $this->currentPage(),
            //     "first_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'=1',
            //     "prev_page_url" =>  $this->previousPageUrl(),
            //     "next_page_url" =>  $this->nextPageUrl(),
            //     "last_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'='.$this->lastPage(),
            //     "last_page" =>  $this->lastPage(),
            //     "per_page" =>  $this->perPage(),
            //     "total" =>  $this->total(),
            //     "path" =>  $this->getOptions()['path'],
            // ],
        ];
    }
}
