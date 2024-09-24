<?php

namespace App\Controllers;


use App\Models\Orders;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home', ['products' => (new Product())->getAll()]);
    }

    /**
     * @throws \JsonException
     */
    public function orderNow(): false|string
    {
        $response = ['success' => false];
        $data = [
            'username' => filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING),
            'product_id' => filter_var(trim($_POST['product_id']), FILTER_SANITIZE_STRING),
        ];

        if (!empty($data['username']) && !empty($data['product_id'])) {
            $response['success'] = (new Orders())->insert($data);
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }
}
