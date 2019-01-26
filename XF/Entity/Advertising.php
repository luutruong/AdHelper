<?php

namespace Truonglv\AdHelper\XF\Entity;

use Truonglv\AdHelper\App;
use XF\Mvc\Entity\Structure;

class Advertising extends XFCP_Advertising
{
    public function getAdHtml()
    {
        $html = $this->ad_html_;
        if (App::$includeAdInfoIntoHtml) {
            $html = App::prepareAdHtmlForDebug($this, $html);
        }

        return $html;
    }

    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns['tah_is_active_mobile'] = ['type' => self::BOOL, 'default' => true];
        $structure->getters['ad_html'] = [
            'cache' => false,
            'getter' => 'getAdHtml'
        ];

        return $structure;
    }
}
