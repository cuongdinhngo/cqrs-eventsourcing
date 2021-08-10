<?php
namespace App\Repositories\User;

use App\Repositories\BaseInterface;

interface UserRepositoryInterface extends BaseInterface
{
    public function findByConditions(array $conditions);
}
