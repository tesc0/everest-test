<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function find($userId): ?Model;
    public function getUserByEmail($email): ?Model;
}