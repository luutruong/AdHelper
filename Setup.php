<?php
/**
 * @license
 * Copyright 2019 TruongLuu. All Rights Reserved.
 */

namespace Truonglv\AdHelper;

use Truonglv\AdHelper\DevHelper\SetupTrait;
use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
    use SetupTrait;
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $this->doAlterTables($this->getAlters());
    }

    public function uninstallStep1()
    {
        $this->doDropColumns($this->getAlters());
    }

    protected function getAlters1()
    {
        $alters = [];

        $alters['xf_advertising'] = [
            'tah_is_active_mobile' => function (Alter $table) {
                $table->addColumn('tah_is_active_mobile', 'tinyint')
                    ->unsigned()
                    ->setDefault(1);
            }
        ];

        return $alters;
    }
}
