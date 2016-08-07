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

namespace Ctech\Configurator\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 * @package Ctech\Configurator\Helper
 */
class Data extends AbstractHelper
{
    /**
     * get store config from configuration tree
     * @param $key
     * @return mixed
     */
    public function getStoreConfig($key)
    {
        return $this->scopeConfig->getValue("ctech/general/{$key}", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }


    /**
     *
     * helper method to check if current product object is a configuretech product object
     * its always faster to compare numbers instead of fetching the attributeSet name from db
     * @param \Magento\Catalog\Model\Product $product
     * @return bool
     *
     */
    public function isCtechProduct(\Magento\Catalog\Model\Product $product)
    {
        if ($this->getStoreConfig("attribute_set_id") == $product->getAttributeSetId()) {
            return true;
        }
        return false;
    }


    /**
     *
     * get an array of hidden options.
     * @return array
     */
    public function getCheckoutHiddenOptions()
    {

        $config = $this->getStoreConfig("checkout_hidden_options");
        $config = explode(",", $config);
        $hidden_options = array();
        foreach ($config as $c) {
            $hidden_options[] = trim($c);
        }

        return $hidden_options;
    }

}