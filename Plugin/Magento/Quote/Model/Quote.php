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

namespace Ctech\Configurator\Plugin\Magento\Quote\Model;

/**
 * Class Quote
 * @package Ctech\Configurator\Plugin\Magento\Quote\Model
 */
class Quote
{
    /**
     * This allows you to add same product with different custom options to the cart
     * whereas otherwise Magento would normally just +1 the quantity of the product.
     *
     * @todo : refactor later to be work only on Ctech Products
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Closure $proceed
     * @return bool
     */
    public function aroundGetItemByProduct(\Magento\Quote\Model\Quote $quote, \Closure $proceed)
    {
        return false;
    }
}