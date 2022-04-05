<?php

/**
 * @license Apache 2.0
 */

namespace OpenApi\Examples\Petstore30\Models;

/**
 * Class LoginModel.
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 *
 * @OA\Schema(
 *     title="Login model",
 *     description="Login model",
 * )
 */
class LoginModel
{

    /**
     * @OA\Property(
     *     description="Username",
     *     title="Username",
     * )
     *
     * @var string
     */
    private $username;



    /**
     * @OA\Property(
     *     format="int64",
     *     description="Password",
     *     title="Password",
     *     maximum=255
     * )
     *
     * @var string
     */
    private $password;
    
}