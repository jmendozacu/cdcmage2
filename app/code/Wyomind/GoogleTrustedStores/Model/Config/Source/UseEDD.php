<?php

namespace Wyomind\GoogleTrustedStores\Model\Config\Source;

class UseEdd implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        //if (Mage::helper('googletrustedstores')->isEstimatedDeliveryDateEnabled()) {
        //    return array(
        //        array('label' => Mage::helper('googletrustedstores')->__('Yes'), 'value' => '1'),
        //        array('label' => Mage::helper('googletrustedstores')->__('No'), 'value' => '0')
        //    );
        //} else {
        return [
            ['label' => __('No'), 'value' => '0']
        ];
        //}
    }
}
