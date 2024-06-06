<?php

namespace App\Repositories\Link;

use App\Models\Link;
use LaravelEasyRepository\Implementations\Eloquent;

class LinkRepositoryImplement extends Eloquent implements LinkRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     *
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Link $model)
    {
        $this->model = $model;
    }

    public function createLink(array $data): object
    {
        return $this->model->create($data);
    }
}
