<?php

namespace App\Formatters;

use Illuminate\Database\Eloquent\Collection;

class ProductCsvFormatter
{
    /**
     * @const HEADERS
     */
    private const HEADERS = ['ID', 'Name', 'Price'];

    /**
     * @const DELIMITER
     */
    private const DELIMITER = ';';

    /**
     * @param Collection $products
     *
     * @return string
     */
    public function format(Collection $products): string
    {
        $csvData = implode(self::DELIMITER, self::HEADERS) . "\n";

        foreach ($products as $product) {
            $csvData .= implode(self::DELIMITER, [
                    $product->id,
                    $product->name,
                    $product->price,
                ]) . "\n";
        }

        return $csvData;
    }
}
