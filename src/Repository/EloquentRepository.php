<?php

namespace SunAsterisk\Auth\Repository;

use Illuminate\Database\Eloquent\Model;
use SunAsterisk\Auth\Contracts\Repository;

final class EloquentRepository implements Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model, $method], $parameters);
    }

    public function create(array $param = [])
    {
        return $this->model->create($param);
    }

    public function updateById(int $id, array $param = [])
    {
        return $this->model->whereId($id)->update($param);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findByAttribute(array $attribute = [])
    {
        return $this->model->where($attribute)->first();
    }
}