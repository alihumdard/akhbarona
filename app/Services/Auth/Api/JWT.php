<?php

namespace App\Services\Auth\Api;

class JWT extends \Tymon\JWTAuth\JWT
{
    use ExtendsJwtValidation;
}
