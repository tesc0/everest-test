<?php
namespace App\Repository;

use App\Models\Robot;
use Illuminate\Support\Collection;

interface RobotRepositoryInterface
{
    public function getList(): Collection;
}