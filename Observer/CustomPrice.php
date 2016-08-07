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

namespace Ctech\Configurator\Observer;

/**
 * Class CustomPrice
 * @package Ctech\Configurator\Observer
 */
class CustomPrice implements \Magento\Framework\Event\ObserverInterface
{
    /** @var $ctechHelper \Ctech\Configurator\Helper\Data  */
    protected $ctechHelper;

    /**
     * CustomPrice constructor.
     * @param \Ctech\Configurator\Helper\Data $ctechHelper
     */
    public function __construct(\Ctech\Configurator\Helper\Data $ctechHelper)
    {
        $this->ctechHelper = $ctechHelper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var  $item */
        $item = $observer->getEvent()->getData('quote_item');
        /** @var $product \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getData('product');

        if ($this->ctechHelper->isCtechProduct($product)) {
            $item = ($item->getParentItem() ? $item->getParentItem() : $item);
            // Load the custom price
            $finalResult = array();
            $result = array();
            // Load the configured product options
            $options = $item->getProduct()->getTypeInstance(true)->getOrderOptions($item->getProduct());
            // Check for options
            if ($options) {
                if (isset($options['options'])) {
                    $result = array_merge($result, $options['options']);
                }
                if (isset($options['additional_options'])) {
                    $result = array_merge($result, $options['additional_options']);
                }
                if (!empty($options['attributes_info'])) {
                    $result = array_merge($options['attributes_info'], $result);
                }
            }
            $finalResult = array_merge($finalResult, $result);

            $price = "0";
            foreach ($finalResult as $option) {
                if ($option['label'] == "Total") {
                    $price = $option['value'];
                }
            }

            // Set the custom price
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            // Enable super mode on the product.
            $item->getProduct()->setIsSuperMode(true);
        }

    }
}
