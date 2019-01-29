<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 10:26
 */

namespace App\Repositories\Contracts;



use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all();

    public function create(array $data): Model;

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}