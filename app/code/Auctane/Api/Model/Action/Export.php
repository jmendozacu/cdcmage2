<?php

namespace Auctane\Api\Model\Action;

use Exception;

class Export
{
    /**
     * Exclude product type
     */
    const TYPE_CONFIGURABLE = 'configurable';
       
    /**
     * Order collection factory 
     *   
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    private $_order;

    /**
     * Scope config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface 
     */
    private $_scopeConfig;

    /**
     * Xml data
     *
     * @var String
     */
    private $_xmlData = '';

    /**
     * Helper
     *
     * @var \Auctane\Api\Helper\Data
     */
    private $_dataHelper;

    /**
     * Country factory
     *
     * @var \Magento\Directory\Model\CountryFactory
     */
    private $_countryFactory;

    /**
     * EAV Config instance
     *
     * @var \Magento\Eav\Model\Config
     */
    private $_eavConfig;

    /**
     * Price type
     *
     * @var boolean
     */
    private $_priceType = 0;

    /**
     * Import disocunt
     *
     * @var boolean
     */
    private $_importDiscount = 0;

    /**
     * Import child
     *
     * @var boolean
     */
    private $_importChild = 0;

    /**
     * Attributes
     *
     * @var boolean
     */
    private $_attributes = '';

    /**
     * Magento store
     *
     * @var \Magento\Store\Model\ScopeInterface
     */
    private $_store = '';

    /**
     * Product type
     *
     * @var \Magento\Catalog\Model\Product\Type
     */
    private $_typeBundle = '';

    /**
     * Export class constructor
     *
     * @param \CollectionFactory    $order          order
     * @param \ScopeConfigInterface $scopeConfig    config
     * @param \CountryFactory       $countryFactory country factory
     * @param \Config               $eavConfig      config object
     * @param \Data                 $dataHelper     helper object
     *
     * @return boolean
     */
    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $order,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Auctane\Api\Helper\Data $dataHelper
    ) {
        $this->_order = $order;
        $this->_scopeConfig = $scopeConfig;
        $this->_countryFactory = $countryFactory;
        $this->_eavConfig = $eavConfig;
        $this->_dataHelper = $dataHelper;
        //Set the configuartion variable data
        $this->_store = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        //Price export type
        $exportPrice = 'shipstation_general/shipstation/export_price';
        $this->_priceType = $this->_scopeConfig->getValue(
            $exportPrice,
            $this->_store
        );
        //Check import discount
        $importDiscount = 'shipstation_general/shipstation/import_discounts';
        $this->_importDiscount =  $this->_scopeConfig->getValue(
            $importDiscount,
            $this->_store
        );
        //Check for the import child items for the bundle product
        $importChild = 'shipstation_general/shipstation/import_child_products';
        $this->_importChild = $this->_scopeConfig->getValue(
            $importChild,
            $this->_store
        );
        //Check for the import child items for the bundle product
        $attributes = 'shipstation_general/shipstation/attribute';
        $this->_attributes = $this->_scopeConfig->getValue(
            $attributes,
            $this->_store
        );

        $this->_typeBundle = \Magento\Catalog\Model\Product\Type::TYPE_BUNDLE;
    }

    /**
     * Perform an export according to the given request.
     *
     * @param object  $request get requested data
     * @param integer $storeId get store id
     *
     * @return boolean
     */
    public function process($request, $storeId)
    {
        try {
            header('Content-Type: text/xml');

            $startDate = strtotime(urldecode($request->getParam('start_date')));
            $endDate = strtotime(urldecode($request->getParam('end_date')));
            $page = (int) $request->getParam('page');

            $from = date('Y-m-d H:i:s', $startDate);
            $end = date('Y-m-d H:i:s', $endDate);

            $this->_xmlData = "<?xml version=\"1.0\" encoding=\"utf-16\"?>\n";
            $this->_xmlData .= "<Orders>\n";
            /**
             * Get orders from start date and end date.
             * Call the getOrdersFromRenewDate model function
             */
            if ($startDate && $endDate) {
                $orders = $this->_order->create()
                    ->addAttributeToSort('updated_at', 'desc')
                    ->addAttributeToFilter(
                        'updated_at', 
                        ['from' => $from,'to' => $end]
                    );
                //Add the order filter for the specific store
                if ($storeId) {
                    $orders->addAttributeToFilter('store_id', $storeId);
                }
        
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if (!empty($order)) {
                            // check if shipping info is available with order.
                            $orderShipping = $order->getShippingDescription();
                            if ($orderShipping) {       
                                $this->_writeOrder($order);
                            } else {
                                continue;
                            }
                        } else {
                            continue;
                        }
                    } 
                }
            } else {
                $this->_xmlData .= "<date>date required</date>\n";
            }
            $this->_xmlData .= "</Orders>";
            echo $this->_xmlData;
        } catch (Exception $fault) {
            $this->_dataHelper->fault($fault->getCode(), $fault->getMessage());
        }
        exit;
    }

    /**
     * Function to add field to xml
     *
     * @param string $strFieldName name
     * @param string $strValue     value
     *
     * @return xml
     */
    private function _addFieldToXML($strFieldName, $strValue)
    {
        $strResult = mb_convert_encoding(
            str_replace('&', '&amp;', $strValue),
            'UTF-8'
        );
        $this->_xmlData .= "\t\t<$strFieldName>$strResult</$strFieldName>\n";
    }

    /**
     * Write the order in xml file
     *
     * @param \Magento\Sales\Model\Order $order order details
     *
     * @return order
     */
    private function _writeOrder($order)
    {
        $this->_xmlData .= "\t<Order>\n";
        $this->_addFieldToXML("OrderNumber", $order->getIncrementId());
        $this->_addFieldToXML("OrderDate", $order->getCreatedAt());
        $this->_addFieldToXML("OrderStatus", $order->getStatus());
        $this->_addFieldToXML("LastModified", $order->getUpdatedAt());
        //Get the shipping method name and carrier name
        $this->_addFieldToXML(
            "ShippingMethod", 
            $order->getShippingDescription()
        );
        //Check for the price type
        if ($this->_priceType) {
            $orderTotal = $order->getBaseGrandTotal();
            $orderTax = $order->getBaseTaxAmount();
            $orderShipping = $order->getBaseShippingAmount();
        } else {
            $orderTotal = $order->getGrandTotal();
            $orderTax = $order->getTaxAmount();
            $orderShipping = $order->getShippingAmount();
        }
        $this->_addFieldToXML("OrderTotal", $orderTotal);
        $this->_addFieldToXML("TaxAmount", $orderTax);
        $this->_addFieldToXML("ShippingAmount", $orderShipping);
        $this->_addFieldToXML(
            "InternalNotes",
            '<![CDATA[' . $order->getCustomerNote() .']]>'
        );
        //Customer details
        $this->_xmlData .= "\t<Customer>\n";
        $this->_addFieldToXML("CustomerCode", $order->getCustomerEmail());
        $this->_getBillingInfo($order); //call to the billing info function
        $this->_getShippingInfo($order); //call to the shipping info function
        $this->_xmlData .= "\t</Customer>\n";
        $this->_xmlData .= "\t<Items>\n";
        $this->_orderItem($order); //call to the order items function
        //Get the order discounts
        if ($this->_importDiscount && $order->getDiscountAmount() != '0.0000') {
            $this->_getOrderDiscounts($order);
        }

        $this->_xmlData .= "\t</Items>\n";
        $this->_xmlData .= "\t</Order>\n";
    }

    /**
     * Get the Billing information of order
     *
     * @param \Magento\Sales\Model\Order $order billing information
     *
     * @return billing information
     */
    private function _getBillingInfo($order)
    {
        $billing = $order->getBillingAddress();
        if (!empty($billing)) {
            $name = $billing->getFirstname() . ' ' . $billing->getLastname();
            $this->_xmlData .= "\t<BillTo>\n";
            $this->_addFieldToXML("Name", '<![CDATA[' . $name . ']]>');
            $this->_addFieldToXML(
                "Company",
                '<![CDATA[' . $billing->getCompany() . ']]>'
            );
            $this->_addFieldToXML("Phone", $billing->getTelephone());
            $this->_addFieldToXML("Email", $order->getCustomerEmail());
            $this->_xmlData .= "\t</BillTo>\n";
        }
    }

    /**
     * Get the Shipping information of order
     *
     * @param \Magento\Sales\Model\Order $order get shipping information
     *
     * @return Shipping information
     */
    private function _getShippingInfo($order)
    {
        $shipping = $order->getShippingAddress();
        if (!empty($shipping)) {
            $name = $shipping->getFirstname() . ' ' . $shipping->getLastname();
            $country = $this->_countryFactory->create()
                ->loadByCode($shipping->getCountryId())->getName();

            $this->_xmlData .= "\t<ShipTo>\n";
            $this->_addFieldToXML("Name", '<![CDATA[' . $name . ']]>');
            $this->_addFieldToXML(
                "Company",
                '<![CDATA[' . $shipping->getCompany() . ']]>'
            );
            $this->_addFieldToXML(
                "Address1",
                '<![CDATA[' . $shipping->getStreetLine(1) . ']]>'
            );
            $this->_addFieldToXML(
                "Address2",
                '<![CDATA[' . $shipping->getStreetLine(2) . ']]>'
            );
            $this->_addFieldToXML(
                "City",
                '<![CDATA[' . $shipping->getCity() . ']]>'
            );
            $this->_addFieldToXML(
                "State",
                '<![CDATA[' . $shipping->getRegion() . ']]>'
            );
            $this->_addFieldToXML("PostalCode", $shipping->getPostcode());
            $this->_addFieldToXML("Country", '<![CDATA[' . $country. ']]>');
            $this->_addFieldToXML("Phone", $shipping->getTelephone());
            $this->_xmlData .= "\t</ShipTo>\n";
        }
    }

    /**
     * Write the order discount details in to the xml response data
     *
     * @param \Magento\Sales\Model\Order $order order object
     * 
     * @return orer discount
     */
    private function _getOrderDiscounts($order)
    {
        if ($order->getCouponCode()) {
            $code = $order->getCouponCode();
        } else {
            $code = 'AUTOMATIC_DISCOUNT';
        }
        $this->_xmlData .= "\t<Item>\n";
        $this->_addFieldToXML("SKU", $code);
        $this->_addFieldToXML("Name", '');
        $this->_addFieldToXML("Adjustment", 'true');
        $this->_addFieldToXML("Quantity", 1);
        $this->_addFieldToXML("UnitPrice", $order->getDiscountAmount());
        $this->_xmlData .= "\t</Item>\n";
     
    }

    /**
     * Write the order item in xml response data
     *
     * @param \Magento\Sales\Model\Order $order order object
     *
     * @return order
     */
    private function _orderItem($order)
    {
        if (!empty($order->getItems())) {
            $imageUrl = '';
            foreach ($order->getItems() as $orderItem) {
                $type = $orderItem->getProductType();
                $isVirtual = $orderItem->getIsVirtual();
                if ($type == self::TYPE_CONFIGURABLE || $isVirtual) {
                    continue;
                }
                //Get the parent item from the order item
                $parentItem = $orderItem->getParentItem();
                $weight = $orderItem->getWeight();
                if ($this->_priceType) {
                    $price = $orderItem->getBasePrice();
                } else {
                    $price = $orderItem->getPrice();
                }
                $name = $orderItem->getName();
                $product = $orderItem->getProduct();
                // check for the product object to return the image resource.
                if (!empty($product)) {
                    $attribute = $orderItem->getProduct()->getResource()
                        ->getAttribute('small_image');

                    $imageUrl = $attribute->getFrontend()
                        ->getUrl($orderItem->getProduct());
                }
                
                if (!empty($parentItem)) {
                    $type = $parentItem->getProductType();
                    if ($type == $this->_typeBundle) {
                        //Remove child items from the response data
                        if (!$this->_importChild) {
                            continue;
                        }
                        $weight = $price = 0;
                    }
                    //set the item price from parent item price
                    if ($type == self::TYPE_CONFIGURABLE) {
                        if ($price == '0.0000' || $price == null ) {
                            if ($this->_priceType) {
                                $price = $parentItem->getBasePrice();
                            } else {
                                $price = $parentItem->getPrice();     
                            }
                        }
                        $name = $parentItem->getName();
                    }
                    // Set the parent image url if the item image is not set.
                    $product = $parentItem->getProduct();
                    if (!$imageUrl && !empty($product)) {
                        $attribute = $parentItem->getProduct()->getResource()
                            ->getAttribute('small_image');

                        $imageUrl = $attribute->getFrontend()
                            ->getUrl($parentItem->getProduct());
                    }
                }
                
                if (!empty($orderItem)) {
                    $this->_xmlData .= "\t<Item>\n";
                    $this->_addFieldToXML("SKU", $orderItem->getSku());
                    $this->_addFieldToXML("Name", $name);
                    $this->_addFieldToXML("ImageUrl", $imageUrl);
                    $this->_addFieldToXML("Weight", $weight);
                    $this->_addFieldToXML("UnitPrice", $price);
                    $this->_addFieldToXML(
                        "Quantity",
                        intval($orderItem->getQtyOrdered())
                    );
                    /*
                     * Check for the custom attributes
                     */
                    $this->_xmlData .="\t<Options>\n";
                    $list = [];
                    $attributeCodes = explode(',', $this->_attributes);
                    foreach ($attributeCodes as $attributeCode) {
                        $product = $orderItem->getProduct();
                        $data = '';
                        if (!empty($product)) {
                            $data = $orderItem->getProduct()
                                ->hasData($attributeCode);   
                        }
                        if ($attributeCode && $data) {
                            $attribute = $this->_eavConfig->getAttribute(
                                $this->_getEntityType(), $attributeCode
                            );
                            $name = $attribute->getFrontendLabel();
                            $inputType = $attribute->getFrontendInput();
                            if (in_array($inputType, ['select', 'multiselect'])) {
                                $value = $orderItem->getProduct()
                                    ->getAttributeText($attributeCode);
                            } else {
                                $value = $orderItem->getProduct()
                                    ->getData($attributeCode); 
                            }
                            //Add option to xml data
                            if ($value) {
                                $this->_writeOption($name, $value);
                                $list[] = $name;
                            }
                        }
                    }
                    $this->_xmlData .= "\t</Options>\n";
                    $this->_xmlData .= "\t</Item>\n";
                }
            }
        }
    }

    /**
     * Retrieve entity type
     *
     * @return string
     */
    private function _getEntityType()
    {
        return \Magento\Catalog\Model\Product::ENTITY;
    }

    /**
     * Write the order discount details in to the xml response data
     *
     * @param string $label XML Node
     * @param string $value XML Value
     *
     * @return Xml
     */
    private function _writeOption($label, $value)
    {
        $this->_xmlData .="\t<Option>\n";
        $this->_addFieldToXML("Name", '<![CDATA[' . $label . ']]>');
        $this->_addFieldToXML("Value", '<![CDATA[' . $value . ']]>');
        $this->_xmlData .="\t</Option>\n";
    }
}