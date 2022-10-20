<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class AppUserResource extends JsonResource
{
    /**
     * @return Collection
     */
    public function stamps(): Collection
    {
        $stamps = new Collection();
        $stampUsages = $this->stamp->usages->toArray();
        $stampImages = $this->stamp->images;
        for ($key = 0; $key < count($stampImages); $key++) {
            $stampImages[$key] = isset($stampUsages[$key])
                ? $stamps->push($stampImages[$key]->image_after_ticked)
                : $stamps->push($stampImages[$key]->image_before_ticked);
        }

        return $stamps;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'app_name' => $this->name,
            'max_stamp' => $this->config_stamp,
            'stamp_images' => $this->stamps(),
        ];
    }
}
