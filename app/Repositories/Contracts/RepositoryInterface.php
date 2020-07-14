<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 10:26
 */

namespace App\Repositories\Contracts;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface RepositoryInterface
 * @package App\Repositories\Contracts
 */
interface RepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return bool|null
     */
    public function update(array $data, int $id): ?bool;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
}
