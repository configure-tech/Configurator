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
     * @var \Ctech\Configurator\Helper\Data
     */
    protected $ctechHelper;

    /**
     * Quote constructor.
     * @param \Ctech\Configurator\Helper\Data $ctechHelper
     */
    public function __construct(
        \Ctech\Configurator\Helper\Data $ctechHelper
    ) {
        $this->ctechHelper = $ctechHelper;
    }

    /**
     * This allows you to add same product with different custom options to the cart
     * whereas otherwise Magento would normally just +1 the quantity of the product.
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Closure $proceed
     * @param   \Magento\Catalog\Model\Product $product
     * @return bool
     */
    public function aroundGetItemByProduct(\Magento\Quote\Model\Quote $quote, \Closure $proceed, $product)
    {
        if ($this->ctechHelper->isCtechProduct($product)) {
            return false;
        }

        return $proceed($product);
    }
}
