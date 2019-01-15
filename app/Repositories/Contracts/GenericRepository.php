<?php


namespace App\Repositories\Contracts;


 use Illuminate\Database\Eloquent\Model;

 class GenericRepository implements Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

     public function all()
     {
         return $this->model->all();
     }

     public function create(array $data): Model
     {
         return $this->model->create($data);
     }

     public function update(array $data, $id)
     {
         return $this->model->find($id)->update($data);
     }

     public function delete($id)
     {
         return $this->model->find($id)->delete();
     }

     public function find($id)
     {
         return $this->model->find($id);
     }
 }