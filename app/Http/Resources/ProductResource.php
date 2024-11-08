<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            Product::CODE             => $this->code,
            Product::STATUS           => $this->status,
            Product::IMPORTED_T       => $this->imported_t,
            Product::URL              => $this->url,
            Product::CREATOR          => $this->creator,
            Product::CREATED_T        => $this->created_t,
            Product::LAST_MODIFIED_T  => $this->last_modified_t,
            Product::PRODUCT_NAME     => $this->product_name,
            Product::QUANTITY         => $this->quantity,
            Product::BRANDS           => $this->brands,
            Product::CATEGORIES       => $this->categories,
            Product::LABELS           => $this->labels,
            Product::CITIES           => $this->cities,
            Product::PURCHASE_PLACES  => $this->purchase_places,
            Product::STORES           => $this->stores,
            Product::INGREDIENTS_TEXT => $this->ingredients_text,
            Product::TRACES           => $this->traces,
            Product::SERVING_SIZE     => $this->serving_size,
            Product::SERVING_QUANTITY => $this->serving_quantity,
            Product::NUTRISCORE_SCORE => $this->nutriscore_score,
            Product::NUTRISCORE_GRADE => $this->nutriscore_grade,
            Product::MAIN_CATEGORY    => $this->main_category,
            Product::IMAGE_URL        => $this->image_url,
        ];
    }
}
