<?php

namespace App\Repository\Eloquent;

use App\Models\Robot;
use App\Repository\RobotRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RobotRepository extends BaseRepository implements RobotRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Robot $model
     */
    public function __construct(Robot $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function getList(): Collection
    {
        return $this->model->select(['applications.*', 'vaccine_types.type'])
        ->join('vaccines', 'applications.vaccine_type_id', '=', 'vaccines.id')
        ->join('vaccine_types', 'vaccine_types.id', '=', 'vaccines.type_id')
        ->get();
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