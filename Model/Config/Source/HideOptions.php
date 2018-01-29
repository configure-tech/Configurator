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
 * Class HideOptions
 * @package Ctech\Configurator\Model\Config\Source
 */
class HideOptions implements \Magento\Framework\Data\OptionSourceInterface
{
    const OPTIONS =  ["Mfr Part Number", "Part Number" , "Total" , "Description"];
    //const OPTIONS =  ["Lloyd Code", "Part Number" , "Total" , "Description"];

    /**
     * creates an array of product options that admin can hide in frontend
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach(self::OPTIONS as $o)
        {
            $options[] = ['value' => $o, 'label' => $o];
        }
        return $options;
    }
}