<?php

namespace Truonglv\AdHelper\XF\Admin\Controller;

class Advertising extends XFCP_Advertising
{
    protected function adSaveProcess(\XF\Entity\Advertising $ad)
    {
        $form = parent::adSaveProcess($ad);

        $form->setupEntityInput($ad, $this->filter([
            'tah_is_active_mobile' => 'bool'
        ]));

        return $form;
    }
}
