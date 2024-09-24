<?php

namespace App\Controllers;

use App\Models\Orders;


class AdminController extends Controller
{
    public function orders()
    {
        $this->view('dashboard/index',['orders' => (new Orders())->getAll()]);
    }

    public function updateStatus(): false|string
    {
        $response = ['success' => false];
        $data = [
            'status' => filter_var(trim($_POST['status']), FILTER_SANITIZE_STRING),
            'id' => filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING),
        ];

        if (!empty($data['status']) && !empty($data['id'])) {
            $response['success'] = (new Orders())->update($data);
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    public function deleteOrder(): false|string
    {
        $response = array('success' => false);
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);

        if (!empty($id)) {
            $response['success'] = (new Orders())->delete($id);
        }

        return json_encode($response, JSON_THROW_ON_ERROR);
    }

}