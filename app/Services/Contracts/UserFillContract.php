<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface UserFillContract
{
    public function fillRegister(array $input);
}
