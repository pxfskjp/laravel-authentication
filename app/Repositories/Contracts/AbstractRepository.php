<?php


namespace App\Repositories\Contracts;


 use Illuminate\Database\Eloquent\Model;

 /**
  * Class AbstractRepository
  * @package App\Repositories\Contracts
  */
 abstract class AbstractRepository implements RepositoryInterface
{
     /**
      * @var Model
      */
     protected $model;

     /**
      * AbstractRepository constructor.
      * @param Model $model
      */
     public function __construct(Model $model)
    {
        $this->model = $model;
    }

     /**
      * @param array $data
      * @return mixed
      */
     public function create(array $data)
     {
         $result = $this->model
             ->create($data);

         if($result)
             return $result;

         return null;
     }

     /**
      * @param array $data
      * @param $id
      * @return bool|null
      */
     public function update(array $data, $id): ?bool
     {
         $result = $this->model
             ->where('id', '=', $id)
             ->update($data);

         if(isset($result))
             return $result;

         return null;
     }

     /**
      * @param $id
      * @return mixed
      */
     public function delete($id)
     {
         $result = $this->model
             ->where('id', '=', $id)
             ->delete();

         if(isset($result))
             return $result;

         return null;
     }

     /**
      * @param $id
      * @return mixed
      */
     public function find($id)
     {
         $result = $this->model
             ->find($id);

         if($result)
             return $result;

         return null;
     }
 }
