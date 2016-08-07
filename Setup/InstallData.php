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

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * Class InstallData
 * @package Ctech\Configurator\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();

        $setup->endSetup();
    }

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
}