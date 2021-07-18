<?php
namespace Neos\Setup\Condition;

/*
 * This file is part of the Neos.Setup package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Doctrine\DBAL\DriverManager;
use Neos\Flow\Configuration\ConfigurationManager;

/**
 * Condition that checks whether connection to the configured database can be established
 */
class DatabaseConnectionCondition extends AbstractCondition
{
    /**
     * Returns TRUE if the condition is satisfied, otherwise FALSE
     *
     * @return boolean
     */
    public function isMet()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Neos.Flow');
        try {
            DriverManager::getConnection($settings['persistence']['backendOptions'])->connect();
        } catch (\PDOException $exception) {
            return false;
        }

        return true;
    }
}
