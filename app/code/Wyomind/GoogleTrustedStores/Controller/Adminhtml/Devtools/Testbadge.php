<?php

namespace Wyomind\GoogleTrustedStores\Controller\Adminhtml\Devtools;

class Testbadge extends \Wyomind\GoogleTrustedStores\Controller\Adminhtml\Devtools
{

    public function execute()
    {
        $this->_view->loadLayout();
        $resultRaw = $this->_resultRawFactory->create();
        $content = $this->_view->getLayout()->createBlock('Wyomind\GoogleTrustedStores\Block\Badge')->setArea('frontend')->setTemplate('Wyomind_GoogleTrustedStores::badge.phtml')->toHtml();
        return $resultRaw->setContents($content);
    }
}
