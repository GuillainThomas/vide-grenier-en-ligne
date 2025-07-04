<?php

use PHPUnit\Framework\TestCase;
use App\Utility\Hash;

class UtilityTest extends TestCase
{
    public function testGenerateUniqueReturnsString()
    {
        $uid = Hash::generateUnique();
        
        $this->assertIsString($uid);
    }

    public function testGenerateUniqueReturnsUniqueValues()
    {
        $uid1 = Hash::generateUnique();
        $uid2 = Hash::generateUnique();

        $this->assertNotEquals($uid1, $uid2, "UIDs should be unique");

    }
}
