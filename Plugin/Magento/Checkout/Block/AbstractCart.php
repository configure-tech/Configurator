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

namespace Ctech\Configurator\Plugin\Magento\Checkout\Block;

/**
 * Class AbstractCart
 * @package Ctech\Configurator\Plugin\Magento\Checkout\Block
 */
class AbstractCart
{
    /**
     * update cart's item renderer template
     *
     * @param \Magento\Checkout\Block\Cart\AbstractCart $subject
     * @param $result
     * @return mixed
     */
    public function afterGetItemRenderer(\Magento\Checkout\Block\Cart\AbstractCart $subject, $result)
    {
        $result->setTemplate('Ctech_Configurator::cart/item/default.phtml');
        return $result;
    }
}