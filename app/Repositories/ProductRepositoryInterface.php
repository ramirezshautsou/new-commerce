<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function paginate($limitPerPage = 15);
}
