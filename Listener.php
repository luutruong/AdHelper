<?php
/**
 * @license
 * Copyright 2019 TruongLuu. All Rights Reserved.
 */

namespace Truonglv\AdHelper;

class Listener
{
    public static function templaterMacroPostRender(\XF\Template\Templater $templater, $type, $template, $name, &$output)
    {
        if ($type !== 'public' || $template !== '_ads' || empty($output)) {
            return;
        }

        if (!class_exists('Mobile_Detect', false)) {
            require_once __DIR__ . '/vendor/autoload.php';
        }

        $detector = new \Mobile_Detect();
        if (!$detector->isMobile()) {
            // no need to remove ad
            return;
        }

        $beginBlock = str_replace('%d', '(\d+)', App::TEMPLATE_HTML_BEGIN);
        preg_match_all('#' . $beginBlock . '#', $output, $matches);
        if (empty($matches)) {
            return;
        }

        foreach ($matches[0] as $index => $match) {
            if (!empty($matches[2][$index])) {
                // it's accept to show on mobile
                continue;
            }

            $endBlock = str_replace('%d', $matches[1][$index], App::TEMPLATE_HTML_END);
            $beginBlockPos = strpos($output, $match);
            $endBlockPos = strpos($output, $endBlock);

            if ($beginBlockPos !== false && $endBlockPos !== false) {
                $output = substr($output, 0, $beginBlockPos + strlen($match))
                    . '<!-- TAH: Ad has removed for mobile device -->'
                    . substr($output, $endBlockPos);
            }
        }
    }
}
