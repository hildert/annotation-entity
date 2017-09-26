<?php
namespace Hildert\Entity;

use Hildert\Tests\MockObject\UserEntity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{

    public function testExchangeArray()
    {
       $user = new UserEntity();
       $userData = [
           "id" => 1,
           "user_name" => 'hildert',
           'gender' => 'male'
       ];
       $user->exchangeArray($userData);
       $this->assertEquals(1, $user->id);
       $this->assertEquals('hildert', $user->userName);
       $this->assertEquals('male', $user->gender);
    }
}