<?php

namespace Hildert\Tests\MockObject;

use Hildert\Entity\Entity;

final class UserEntity extends Entity
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     * @Hildert\Column\Column(name="user_name")
     */
    public $userName;

    /**
     * @var string
     */
    public $gender;
}