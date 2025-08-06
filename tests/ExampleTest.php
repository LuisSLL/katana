<?php
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\HomeController;

class ExampleTest extends TestCase
{
    public function testHomeControllerReturnsView()
    {
        $controller = new HomeController();
        $result = $controller->index();
        $this->assertStringContainsString('Katana PHP Framework', $result);
    }
}