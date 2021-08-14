<?php

namespace App\Repositories;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     *
     * @return void
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Find by id
     *
     * @param [type] $id
     * @param array $select
     * @return void
     */
    public function find($id, array $select = ['*'])
    {
        $result = $this->model->find($id, $select);

        return $result;
    }

    /**
     * Create
     *
     * @param array $attributes
     * @return void
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     *
     * @param [type] $id
     * @param array $attributes
     * @return void
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Insert
     *
     * @param array $attributes
     * @return void
     */
    public function insert($attributes = [])
    {
        return $this->model->insert($attributes);
    }
}