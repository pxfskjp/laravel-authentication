<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 11:21
 */

namespace App\Services\Contracts;


use App\Repositories\Contracts\Repository;
use Illuminate\Http\Request;

abstract class GenericService implements Service
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository ;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function read($id)
    {
        return $this->repository->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($id, $request->all());
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}