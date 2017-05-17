<?php

namespace Wyomind\GoogleTrustedStores\Controller\Adminhtml;

abstract class Devtools extends \Magento\Backend\App\Action
{

    protected $_resultRawFactory = null;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->_resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Wyomind_GoogleTrustedStores::devtools');
    }

    protected function _initAction()
    {
        $this->_view->loadLayout();
        return $this;
    }
    
    abstract public function execute();
}
