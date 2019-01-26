<?php

namespace Truonglv\AdHelper\XF\Service\Advertising;

use Truonglv\AdHelper\App;

class Writer extends XFCP_Writer
{
    protected function prepareAdContents(array $ads)
    {
        App::$includeAdInfoIntoHtml = true;

        return parent::prepareAdContents($ads);
    }
}
