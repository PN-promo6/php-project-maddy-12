<?php

namespace Entity;

use ludk\Utils\Serializer;

class Type
{
    public int $id;
    public string $name;
    use Serializer;
}
