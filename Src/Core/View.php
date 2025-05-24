<?php
//    Src/Core/View.php
namespace Src\Core;

class View
{
    protected static string $basePath = __DIR__ . '/../../Resources/Views';
    protected static ?string $layout = null;
    protected static array $sections = [];
    protected static array $sectionStack = [];

    public static function render($view, $data = [])
    {
        $viewFile = self::$basePath . '/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("❌ Vista no encontrada: $viewFile");
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        if (self::$layout) {
            $layoutFile = self::$basePath . '/layouts/' . self::$layout . '.php';

            if (!file_exists($layoutFile)) {
                die("❌ Layout no encontrado: $layoutFile");
            }

            ob_start();
            include $layoutFile;
            return ob_get_clean();
        }

        return $content;
    }

    public static function setLayout($name)
    {
        self::$layout = $name;
    }

    public static function startSection($name)
    {
        self::$sectionStack[] = $name;
        ob_start();
    }

    public static function endSection()
    {
        $content = ob_get_clean();
        $section = array_pop(self::$sectionStack);
        self::$sections[$section] = $content;
    }

    public static function getSection($name)
    {
        return self::$sections[$name] ?? '';
    }
}
