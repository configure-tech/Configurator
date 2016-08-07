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

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 * @package Ctech\Configurator\Setup
 */
class UpgradeData implements UpgradeDataInterface {

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
	public function upgrade(
		ModuleDataSetupInterface $setup,
		ModuleContextInterface $context
	){
		$setup->startSetup();
		if(version_compare($context->getVersion(), "0.0.1", "<")){
		//Your upgrade script
		}
		$setup->endSetup();
	}
}