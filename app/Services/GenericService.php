<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class GenericService
{
    public function __construct(
        private Model $model
    ) {}

    public function preCreate(array &$data)
    {
        return $data;
    }

    public function create(array $data): Model
    {
        $this->preCreate($data);

        $newModel = $this->model->newInstance();

        $newModel->fill($data)->save();

        return $newModel;
    }

    public function preUpdate(array &$data)
    {
        return $data;
    }

    public function update($id, array $data)
    {
        $model = $this->model->newQuery()->findOrFail($id);

        $this->preUpdate($data);
        
        $model->fill($data)->save();
        $model->refresh();

        return $model;
    }

    public function delete($id): bool
    {
        $model = $this->model->newQuery()->findOrFail($id);

        $model->delete();

        return true;
    }
}