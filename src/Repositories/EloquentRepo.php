<?php

namespace Ksoft\Klaravel\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Ksoft\Klaravel\Contracts\EloquentRepoContract as Contract;

abstract class EloquentRepo implements Contract
{
    /**
    * @var $model
    */
    protected $model;


    /**
     * This is the only mandatary function you have to implement,
     * Return your model class here.
     *
     * {@inheritdoc}
     */
    abstract protected function model();


    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model->getModel()),
                $id
            );
        }

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function findWhere($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findWhereFirst($column, $value)
    {
        $model = $this->model->where($column, $value)->first();

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->model->getModel())
            );
        }

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function findWhereLike($column, $value, $paginate = 0)
    {
        $query = $this->model;
        if (is_array($column)) {
            $i=0;
            foreach ($column as $columnItem) {
                if ($i==0) {
                    $query->where($column, 'like', $value);
                } else {
                    $query->orWhere($column, 'like', $value);
                }
                $i++;
            }
        } else {
          $query->where($column, 'like', $value);
        }
        return $paginate > 0 ? $query->paginate($paginate) : $query->get();
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $properties)
    {
        return $this->model->create($properties);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $properties)
    {
        return $this->find($id)->update($properties);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
