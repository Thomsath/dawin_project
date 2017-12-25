<?php

namespace SmartCartBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmartCartBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
