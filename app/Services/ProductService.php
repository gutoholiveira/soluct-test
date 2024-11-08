<?php

namespace App\Services;

use App\Contracts\Services\IProductService;
use App\Enums\ProductStatus;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductService implements IProductService
{
    public function getJsonFileFromOpenFoodFacts(): void
    {
        $indexUrl = 'https://challenges.coode.sh/food/data/json/index.txt';
        $indexResponse = Http::get($indexUrl);
        $indexFiles = explode("\n", $indexResponse->body());

        foreach ($indexFiles as $file) {
            if(!empty($file)){

                $fileUrl = "https://challenges.coode.sh/food/data/json/{$file}";
                
                $file_name = basename($fileUrl);
                
                $fileContent = file_get_contents($fileUrl);
                
                $filePath = "files/{$file_name}";
                
                Storage::put($filePath, $fileContent);
                
                $this->convertGzToJson($filePath);
                
                Storage::delete($filePath);
            }
        }
    }

    public function convertGzToJson(string $filePath): void
    {
        $filePath = storage_path("app/public/" . $filePath);

        $file_name = $filePath;

        $out_file_name = str_replace('.gz', '', $file_name);

        $file = gzopen($file_name, 'rb');
        $out_file = fopen($out_file_name, 'wb');

        $line_count = 0;
        while (!gzeof($file) && $line_count < 100) {

            $line = gzgets($file);

            $decoded_line = json_decode($line, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $data_to_write[] = $decoded_line;
                $line_count++;
            }
        }

        if ($line_count > 0) {
            fwrite($out_file, json_encode($data_to_write, JSON_PRETTY_PRINT));
        }

        fclose($out_file);
        gzclose($file);
    }

    function importOrUpdateProductsByJsonFile(): void
    {
        $errors = [];

        $files = Storage::allFiles('files');

        foreach ($files as $arquivo) {
            try {
                $storage_file = Storage::get($arquivo);

                $decoded_data = json_decode($storage_file, true);

                foreach ($decoded_data as $d_data) {
                    $data = [
                        Product::CODE             => str_replace('"', '', $d_data[Product::CODE]),
                        Product::STATUS           => ProductStatus::PUBLISHED->value,
                        Product::IMPORTED_T       => date('Y-m-d H:i:s'),
                        Product::URL              => $d_data[Product::URL],
                        Product::CREATOR          => $d_data[Product::CREATOR],
                        Product::CREATED_T        => $d_data[Product::CREATED_T],
                        Product::LAST_MODIFIED_T  => $d_data[Product::LAST_MODIFIED_T],
                        Product::PRODUCT_NAME     => $d_data[Product::PRODUCT_NAME],
                        Product::QUANTITY         => $d_data[Product::QUANTITY],
                        Product::BRANDS           => $d_data[Product::BRANDS],
                        Product::CATEGORIES       => $d_data[Product::CATEGORIES],
                        Product::LABELS           => $d_data[Product::LABELS],
                        Product::CITIES           => $d_data[Product::CITIES],
                        Product::PURCHASE_PLACES  => $d_data[Product::PURCHASE_PLACES],
                        Product::STORES           => $d_data[Product::STORES],
                        Product::INGREDIENTS_TEXT => $d_data[Product::INGREDIENTS_TEXT],
                        Product::TRACES           => $d_data[Product::TRACES],
                        Product::SERVING_SIZE     => $d_data[Product::SERVING_SIZE],
                        Product::SERVING_QUANTITY => (float) $d_data[Product::SERVING_QUANTITY],
                        Product::NUTRISCORE_SCORE => (int) $d_data[Product::NUTRISCORE_SCORE],
                        Product::NUTRISCORE_GRADE => $d_data[Product::NUTRISCORE_GRADE],
                        Product::MAIN_CATEGORY    => $d_data[Product::MAIN_CATEGORY],
                        Product::IMAGE_URL        => $d_data[Product::IMAGE_URL],
                    ];

                    $product = Product::firstOrCreate([Product::CODE => str_replace('"', '', $d_data[Product::CODE])], $data);

                    if (!empty($product)) {
                        $product->update($data);
                    }
                }
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }

            (new HistoryImportService())->store($arquivo, $errors);
        }
    }

    public function executeImportProductsRoutine(): void
    {
        $this->getJsonFileFromOpenFoodFacts();
        $this->importOrUpdateProductsByJsonFile();
    }

    public function getAllProducts(): LengthAwarePaginator
    {
        return DB::table('products')->paginate(30);
    }

    public function update(Product $product, ProductRequest $request): Product
    {
        try {
            $product->update($request->toArray());

            return $product->refresh();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Product $product): Product
    {
        try {
            $product->update([
                Product::STATUS => ProductStatus::TRASH
            ]);

            return $product->refresh();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
