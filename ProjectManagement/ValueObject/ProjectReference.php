<?php

namespace ProjectManagement\ValueObject;

class ProjectReference
{
    public static function generate()
    {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . rand(1000, 9999);
    }
}
