<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 11:15
 */

namespace App\Services\Contracts;


use Illuminate\Http\Request;

interface Service
{
    public function index();

    public function create(Request $request);

    public function read($id);

    public function update(Request $request, $id);

    public function delete($id);
}