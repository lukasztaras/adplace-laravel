<?php

namespace App\Repositories;

interface RepositoryInterface {
    public function getAll();
    public function getById($id);
}