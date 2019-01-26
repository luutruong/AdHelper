<?php
/**
 * @license
 * Copyright 2019 TruongLuu. All Rights Reserved.
 */

namespace Truonglv\AdHelper;

use XF\Entity\Advertising;

class App
{
    const TEMPLATE_HTML_BEGIN = '<!-- TAH_Advertising_Begin_%d mobile=%d -->';
    const TEMPLATE_HTML_END = '<!-- TAH_Advertising_End_%d -->';

    public static $includeAdInfoIntoHtml = false;

    public static function prepareAdHtmlForDebug(Advertising $ad, $html)
    {
        return sprintf(self::TEMPLATE_HTML_BEGIN, $ad->ad_id, $ad->get('tah_is_active_mobile'))
            . $html
            . sprintf(self::TEMPLATE_HTML_END, $ad->ad_id);
    }
}
