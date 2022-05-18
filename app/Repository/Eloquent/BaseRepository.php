<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function insert($insert): ?bool
    {
        return $this->model->insert($insert);
    }

    public function update($where, $update): ?int
    {
        return $this->model->where($where)->update($update);
    }

    public function delete($id): bool
    {
        try {
            $this->model->where(['id' => $id])->delete();

            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}