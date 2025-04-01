<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductMailController extends Controller
{
    public function export(Request $request): RedirectResponse
    {
        // Получаем все продукты из базы данных
        $products = Product::all();

        // Формируем данные для CSV
        $csvData = "ID,Name,Price\n";
        foreach ($products as $product) {
            $csvData .= $product->id . "," . $product->name . "," . $product->price . "\n";
        }

        // Определяем путь к файлу для сохранения в S3
        $filePath = 'products.csv';

        // Сохраняем CSV в S3
        Storage::disk('s3')->put($filePath, $csvData);

        // Отправляем email админу
/*        Mail::to('belford2014@gmail.com')->send(new ExportCompleted($filePath));*/

        // Возвращаем сообщение об успешном экспорте
        return back()->with('success', 'Export completed');
    }
}

