<?php

namespace App\Http\Requests;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Product::STATUS           => [Rule::enum(ProductStatus::class)],
            Product::URL              => ['string'],
            Product::CREATOR          => ['string'],
            Product::PRODUCT_NAME     => ['string'],
            Product::QUANTITY         => ['string'],
            Product::BRANDS           => ['string'],
            Product::CATEGORIES       => ['string'],
            Product::LABELS           => ['string'],
            Product::CITIES           => ['string'],
            Product::PURCHASE_PLACES  => ['string'],
            Product::STORES           => ['string'],
            Product::INGREDIENTS_TEXT => ['string'],
            Product::TRACES           => ['string'],
            Product::SERVING_SIZE     => ['string'],
            Product::SERVING_QUANTITY => ['string'],
            Product::NUTRISCORE_SCORE => ['integer'],
            Product::NUTRISCORE_GRADE => ['string'],
            Product::MAIN_CATEGORY    => ['string'],
            Product::IMAGE_URL        => ['string'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $status           = strip_tags(trim($this->status));
        $url              = strip_tags(trim($this->url));
        $creator          = strip_tags(trim($this->creator));
        $product_name     = strip_tags(trim($this->product_name));
        $quantity         = strip_tags(trim($this->quantity));
        $brands           = strip_tags(trim($this->brands));
        $categories       = strip_tags(trim($this->categories));
        $labels           = strip_tags(trim($this->labels));
        $cities           = strip_tags(trim($this->cities));
        $purchase_places  = strip_tags(trim($this->purchase_places));
        $stores           = strip_tags(trim($this->stores));
        $ingredients_text = strip_tags(trim($this->ingredients_text));
        $traces           = strip_tags(trim($this->traces));
        $serving_size     = strip_tags(trim($this->serving_size));
        $serving_quantity = strip_tags(trim($this->serving_quantity));
        $nutriscore_score = strip_tags(trim($this->nutriscore_score));
        $nutriscore_grade = strip_tags(trim($this->nutriscore_grade));
        $main_category    = strip_tags(trim($this->main_category));
        $image_url        = strip_tags(trim($this->image_url));

        $this->merge([
            Product::STATUS           => $status,
            Product::URL              => $url,
            Product::CREATOR          => $creator,
            Product::PRODUCT_NAME     => $product_name,
            Product::QUANTITY         => $quantity,
            Product::BRANDS           => $brands,
            Product::CATEGORIES       => $categories,
            Product::LABELS           => $labels,
            Product::CITIES           => $cities,
            Product::PURCHASE_PLACES  => $purchase_places,
            Product::STORES           => $stores,
            Product::INGREDIENTS_TEXT => $ingredients_text,
            Product::TRACES           => $traces,
            Product::SERVING_SIZE     => $serving_size,
            Product::SERVING_QUANTITY => $serving_quantity,
            Product::NUTRISCORE_SCORE => $nutriscore_score,
            Product::NUTRISCORE_GRADE => $nutriscore_grade,
            Product::MAIN_CATEGORY    => $main_category,
            Product::IMAGE_URL        => $image_url,
        ]);
    }
}
