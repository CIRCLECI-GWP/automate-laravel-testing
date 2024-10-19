<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ExampleUnitTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }


    public function testUserCreation()
    {
        Hash::shouldReceive('make')
            ->once()
            ->with('testpassword')
            ->andReturn('hashedpassword');

        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAttribute'])
            ->getMock();

        $user->method('getAttribute')
            ->willReturnMap([
                ['name', 'Test User'],
                ['email', 'test@mail.com'],
                ['password', 'hashedpassword'],
            ]);

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('hashedpassword', $user->password);
    }
}
