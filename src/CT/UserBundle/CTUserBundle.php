<?php

namespace CT\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CTUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
