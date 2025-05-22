<?php
//  Src/Core/BaseController.php
// Src/Core/BaseController.php
namespace Src\Core;

class BaseController
{
    protected function view($view, $data = [], $layout = 'main')
    {
        View::setLayout($layout);
        echo View::render($view, $data);
    }
}
