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
namespace Ctech\Configurator\Model\Config\Source;

/**
 * Class AttributeSetList
 * @package Ctech\Configurator\Model\Config\Source
 */
class AttributeSetList implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get all attribute sets
     * @return array
     */
    public function toOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $coll = $objectManager->create(\Magento\Catalog\Model\Product\AttributeSet\Options::class);
        $options = [['label' => 'Select Attribute Set', 'value' => '']];
        foreach ($coll->toOptionArray() as $d) {
            $options[] = ['label' => $d['label'], 'value' => $d['value']];
        }
        return $options;
    }
}