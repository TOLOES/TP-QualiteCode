<?php

//namespace UPJV\INSSET\Tests;

use PHPUnit\Framework\TestCase;
use UPJV\INSSET\Validator;
use PHPUnit\Framework\Attribute\CoversClass;

require_once __DIR__.'/../src/UPJV/Validator/Appartient_A.php';

#[CoversClass("Validator")]
final class ValidatorTest extends TestCase
{
    /**
     * @covers Validator::check
     */
    public function testcheck()
    {
        // Arrange
        $str = "abc";

        // Act+
        $ref=new Validator();
        $result = $ref->check($str);

        // Assert
        $this->assertTrue($result);

        // Arrange
        $str = "a";
        $result = $ref->check($str);

        // Assert
        $this->assertFalse($result);
    }
}