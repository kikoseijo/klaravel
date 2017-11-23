<?php

namespace Ksoft\Klaravel\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Ksoft\Klaravel\Exceptions\NoEntityDefined;
use Ksoft\Klaravel\Contracts\EloquentRepo as Contract;

abstract class EloquentRepo implements Contract
{
    /**
     * @var $model
     */
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveEntity();
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

    /**
     * {@inheritdoc}
     */
    protected function resolveEntity()
    {
        if (!method_exists($this, 'model')) {
            throw new NoEntityDefined();
        }

        return app($this->model());
    }
}
