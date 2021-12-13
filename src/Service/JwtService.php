<?php

namespace Greendot\ImagePullerClient\Service;

use ReallySimpleJWT\Token;

class JwtService
{
    private string $jwtUser;
    private string $jwtPass;

    public function __construct(string $jwtPass, string $jwtUser)
    {
        $this->jwtUser = $jwtUser;
        $this->jwtPass = $jwtPass;
    }

    public function isValid(string $token): bool
    {
        return Token::validate($token, $this->jwtPass);
    }
}