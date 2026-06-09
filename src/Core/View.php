<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

final class View
{
    public static function render(string $template, array $data = [], ?string $layout = 'base'): string
    {
        extract($data, EXTR_SKIP);
        $extra_css = '';
        $extra_js = '';
        ob_start();
        $templateFile = base_path('templates/' . $template . '.php');
        if (!is_file($templateFile)) {
            throw new RuntimeException("Template not found: {$template}");
        }
        require $templateFile;
        $content = ob_get_clean() ?: '';

        if ($layout === null) {
            return $content;
        }

        ob_start();
        $layoutFile = base_path('templates/layouts/' . $layout . '.php');
        if (!is_file($layoutFile)) {
            throw new RuntimeException("Layout not found: {$layout}");
        }
        require $layoutFile;
        return ob_get_clean() ?: '';
    }
}
