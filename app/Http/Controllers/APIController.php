<?php


namespace App\Http\Controllers;


/**
 * @OA\Info(
 *     title="Laravel + Passport + Vue example app",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="alex.shabramov@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Parameter(
 *     name="accept",
 *     in="header",
 *     required=true,
 *     description="Accept json header",
 *     @OA\Schema(
 *         type="accept"
 *     )
 * ),
 * @OA\Server(
 *     description="Lua Chat Open API server",
 *     url="http://127.0.0.1:8003/api"
 * )
 */
class APIController extends Controller
{

}
