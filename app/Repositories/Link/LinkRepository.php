<?php

namespace App\Repositories\Link;

use LaravelEasyRepository\Repository;

interface LinkRepository extends Repository
{
    public function createLink(array $data): object;
}
