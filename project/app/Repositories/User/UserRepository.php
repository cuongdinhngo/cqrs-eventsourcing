<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Get Model
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Find user by email
     *
     * @param string $email
     *
     * @return Model
     */
    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Find users by conditions
     *
     * @param array $conditions
     * @param array $select
     * @return void
     */
    public function findByConditions(array $conditions, array $select = ['*'])
    {
        return $this->model->select($select)->where($conditions)->get();
    }
}