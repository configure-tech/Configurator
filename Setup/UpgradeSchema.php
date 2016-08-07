<?php

/**
 *
 * ConfigureTech
 *
 * @category    Magento2-module
 * @license MIT
 * @version 0.0.1
 * @author Tawfek Daghistani <tawfekov@gmail.com>
 * @copyright Copyright (c) 2016  ConfigureTech, Inc <http://www.configuretech.com/>
 *
 */

namespace Ctech\Configurator\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class UpgradeSchema
 * @package Ctech\Configurator\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface {

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
	public function upgrade(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	){
		$setup->startSetup();
		if(version_compare($context->getVersion(), "0.0.1", "<")){
		//Your upgrade script
		}
		$setup->endSetup();
	}
}