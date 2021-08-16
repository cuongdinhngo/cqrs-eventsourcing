<?php
namespace App\Contracts;

interface User extends Crud
{
    public function findByConditions(array $conditions);
}
