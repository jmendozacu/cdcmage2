<?php

namespace Wyomind\GoogleTrustedStores\Controller\Adminhtml\Devtools;

class Testorder extends \Wyomind\GoogleTrustedStores\Controller\Adminhtml\Devtools
{

    public function execute()
    {
        $this->_view->loadLayout();
        $resultRaw = $this->_resultRawFactory->create();
        $content = $this->_view->getLayout()->createBlock('Wyomind\GoogleTrustedStores\Block\Order')->setArea('frontend')->setTemplate('Wyomind_GoogleTrustedStores::order.phtml')->toHtml();
        return $resultRaw->setContents($content);
    }
}
