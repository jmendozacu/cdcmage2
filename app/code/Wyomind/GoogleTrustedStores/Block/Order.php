<?php

/**
 * The technical support is guaranteed for all modules proposed by Wyomind.
 * The below code is obfuscated in order to protect the module's copyright as well as the integrity of the license and of the source code.
 * The support cannot apply if modifications have been made to the original source code (https://www.wyomind.com/terms-and-conditions.html).
 * Nonetheless, Wyomind remains available to answer any question you might have and find the solutions adapted to your needs.
 * Feel free to contact our technical team from your Wyomind account in My account > My tickets. 
 * Copyright © 2016 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\GoogleTrustedStores\Block;

class Order extends \Magento\Framework\View\Element\Template {

    public $xdd = null;
    public $x8a = null;
    public $x15 = null;
    protected $_items = [];
    protected $_order = null;
    protected $_domain = "";
    protected $_email = "";
    protected $_country = "";
    protected $_currencyCode = "";
    protected $_orderTotal = 0;
    protected $_orderDiscount = 0;
    protected $_orderShipping = 0;
    protected $_orderTax = 0;
    protected $_shipDate = "";
    protected $_deliveryDate = "";
    protected $_hasPreorder = "";
    protected $_hasDigital = "";
    protected $_coreRegistry = null;
    protected $_productRepository = null;
    protected $_productCollectionFactory = null;
    public $pcontext = null;
    public $checkoutSession = null;
    public $orderModel = null;
    public $coreHelper = null;
    public $error = false;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Catalog\Block\Product\Context $pcontext, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Sales\Model\Order $orderModel, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Wyomind\Core\Helper\Data $coreHelper, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, array $data = []) {
        $coreHelper->constructor($this, func_get_args());
        parent::__construct($context, $data);
        $this->{$this->x8a->x265->{$this->x8a->x265->x385}} = $pcontext;
        $this->{$this->xdd->x282->{$this->x15->x282->xd18}} = $checkoutSession;
        $this->{$this->x15->x265->{$this->xdd->x265->{$this->x8a->x265->x39f}}} = $orderModel;
        $this->{$this->x15->x265->{$this->x8a->x265->{$this->xdd->x265->{$this->x15->x265->x37a}}}} = $productCollectionFactory;
        $this->{$this->x8a->x265->{$this->x8a->x265->x3aa}} = $coreHelper;
        $this->{$this->x8a->x265->{$this->x8a->x265->x36d}} = $productRepository;
        ${$this->xdd->x287->x16c8} = $this->_storeManager->{$this->x8a->x265->x64b}()->{$this->x8a->x265->x65d}();
        $this->{$this->x15->x265->{$this->xdd->x265->x361}} = $this->{$this->x8a->x265->{$this->x8a->x265->{$this->x15->x265->{$this->x15->x265->x38c}}}}->{$this->x8a->x265->x667}();
        ${$this->xdd->x287->x16d5} = $this->{$this->x15->x282->xd14}->{$this->x8a->x265->x671}();
        $x11c = $this->xdd->x2a4->x2185;
            $x1c5 = $this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->{$this->xdd->x282->xf6c}}};
            $x175 = $this->xdd->x287->{$this->x8a->x287->x18ec};
            $x1c1 = $this->x8a->x282->{$this->x8a->x282->{$this->x15->x282->{$this->xdd->x282->xf85}}};
            $x1d8 = $this->x15->x287->{$this->x8a->x287->x1905};
            $x20f = $this->x8a->x282->{$this->x15->x282->{$this->xdd->x282->xf9f}};
        if (getenv("\x4d\101\107\x45\x5fMOD\x45") == "\x64\145\x76\145\154o\x70\x65\162") {
            
            putenv("\115A\x47E\137\115\117\104\x45=d\x65fa\x75lt");
        } ${$this->x8a->x287->x16e8} = null;
        if (${$this->x8a->x2a4->{$this->x15->x2a4->{$this->x15->x2a4->x1ffc}}}) {
            ${$this->x15->x287->{$this->xdd->x287->{$this->xdd->x287->x16eb}}} = $orderModel->{$this->xdd->x265->x67f}(${$this->xdd->x265->x404});
            ${$this->xdd->x2a4->{$this->x8a->x2a4->{$this->xdd->x2a4->x2015}}} = ${$this->x8a->x2a4->{$this->xdd->x2a4->x1fee}}->{$this->xdd->x265->x687}("\x67\x6fo\147l\145\x74\x72\x75s\164\x65\144s\164\x6f\x72\145\x73\x2f\x67t\163_ord\145rs\57\x65\x74\141\137sh\151\x70");
            ${$this->xdd->x2a4->x201a} = ${$this->x15->x287->{$this->x15->x287->x16cb}}->{$this->xdd->x265->x687}("\147o\x6f\147\154\x65\164r\165st\145\x64\163\164\x6f\162es\x2f\147\x74\x73_\157\x72\144\x65\x72\163/e\164a");
            ${$this->xdd->x265->{$this->x8a->x265->x42b}} = ${$this->x15->x287->{$this->x8a->x287->{$this->xdd->x287->{$this->x8a->x287->x16ce}}}}->{$this->xdd->x265->x687}("\x67\157\157\147\154\x65\x74\162u\163\164\x65\x64\163\164o\162\145\163\x2fgt\x73_\157\x72\144ers\57\x75\163e_e\x64d\137m\x6fd\x75\154\145");
            ${$this->x15->x287->{$this->x8a->x287->{$this->x15->x287->x1718}}} = ${$this->x8a->x265->{$this->x15->x265->{$this->x15->x265->x3fc}}}->{$this->xdd->x265->x687}("\x67\157\157\147\x6c\145\164r\x75s\164e\144\x73\x74o\162\x65\163\57\147\x74s\57\147s\137p\162\157\x64\165ct_i\144");
            ${$this->xdd->x287->{$this->xdd->x287->x1722}} = ${$this->x15->x287->{$this->x8a->x287->{$this->xdd->x287->{$this->x8a->x287->x16ce}}}}->{$this->xdd->x265->x687}("\147\x6f\x6f\x67l\145\164r\x75s\x74\145\x64\163\164\157r\x65\x73/\147\164s\x2f\x63\157\x75n\x74r\171");
            ${$this->x15->x282->{$this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->xdd1}}}} = ${$this->x8a->x265->{$this->xdd->x265->x3f8}}->{$this->xdd->x265->x687}("g\157\x6f\147\x6cetru\x73t\x65d\x73\x74o\162e\163/gts\57gt\163\137\151d");
            ${$this->x15->x287->{$this->x15->x287->x1739}} = ${$this->x15->x282->xd7e}->{$this->xdd->x265->x687}("\147\157og\x6c\145\164\x72u\163\164\145\144\163\164\x6f\162es\x2fg\164\163\57\142\x61\x64ge\137\x70\157\x73i\x74\151\x6fn");
            ${$this->x15->x287->{$this->xdd->x287->{$this->x8a->x287->{$this->x8a->x287->x1746}}}} = ${$this->x8a->x265->{$this->xdd->x265->x3f8}}->{$this->xdd->x265->x687}("\x67\x6f\157gl\x65t\x72\x75\163\x74e\x64s\x74\157r\x65\x73/g\164\163\x2f\154\141n\147\x75\141g\x65");
            ${$this->x8a->x287->{$this->xdd->x287->{$this->x8a->x287->x174d}}} = ${$this->x15->x282->xd7e}->{$this->xdd->x265->x687}("\x67\157\157g\154\145\x74r\x75\x73\164\x65d\163\164\x6f\162\x65\163/\147t\163\x2f\147b\137\x69\x64");
            ${$this->x15->x282->xdf2} = ${$this->x15->x287->{$this->x15->x287->x16cb}}->{$this->xdd->x265->x687}("\x67\157ogl\x65\x74r\x75\x73\x74\145\x64st\x6f\162\x65\163\x2f\147\164s/ba\x64\x67\x65\137c\x6f\x6e\164\x61\x69n\x65r\x5f\143\x73s");
        } elseif ($this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\157rd\145\x72\x2d\x6e\165m\142\145\162") != null && $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\157\x72de\x72\x2d\156\165\155\x62\145\162") != "") {
            ${$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->x417}}} = $orderModel->{$this->x8a->x265->x733}($this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("o\x72\144\145\x72\x2dn\x75m\142\145\x72"));
            ${$this->x8a->x287->{$this->x15->x287->{$this->x8a->x287->x16f5}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("go\x6f\147\x6cetr\165\x73\x74\x65\144\163\164\x6fr\145\x73\x5fg\164\x73\x5f\x6f\x72\x64e\162\x73\137\145t\141\x5fs\150ip");
            ${$this->xdd->x2a4->{$this->x8a->x2a4->x201b}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\x6f\x6f\147\154\145\164\162us\164e\x64\163t\157re\x73\137g\164\x73_\x6f\x72d\145rs\137\145t\141");
            ${$this->x8a->x265->x429} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147oogl\145\x74\162us\164\x65d\x73\164\x6f\x72\x65\x73\x5f\147\x74s_\x6f\162\144e\x72s_\165s\145\137edd\137\155\157du\154\x65");
            ${$this->x15->x287->x1712} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\157og\154\x65\x74\x72\x75\x73te\x64\x73tor\145\x73\x5f\147\x74\x73_g\163\137p\x72\157\144uc\x74\137\151\144");
            ${$this->xdd->x287->{$this->x8a->x287->{$this->x8a->x287->{$this->x8a->x287->x1725}}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("go\x6f\147\154\x65t\x72ust\x65\x64\x73\164\x6fr\x65s\x5f\x67ts\137\143o\165\x6e\x74\x72y");
            ${$this->x8a->x2a4->{$this->x8a->x2a4->{$this->x8a->x2a4->x2037}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("go\157\x67\x6c\145\164r\x75\x73\x74\x65\x64\163\x74\x6fre\x73_\147\x74\x73_gts\x5f\x69d");
            ${$this->x8a->x2a4->{$this->x8a->x2a4->{$this->x15->x2a4->x2042}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\157\157\x67le\164rust\x65d\163\x74\x6f\x72\x65\163\x5f\147\164\163\137\142\x61\144\147\x65\x5f\160\x6fs\x69\x74\151on");
            ${$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->{$this->x15->x265->{$this->x8a->x265->x462}}}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\157\x6f\x67\154\145\x74\162u\x73ted\163\x74\157r\145s\137gts_la\x6e\147ua\147e");
            ${$this->x15->x282->{$this->x8a->x282->xdeb}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("goo\x67\x6c\x65\x74\162\x75s\164\145\x64s\164\157\162e\x73\137gt\x73\137g\142\137\151\x64");
            ${$this->x15->x287->x1754} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\x6f\157\147\x6c\145t\162\x75\x73\x74\145d\x73\x74\x6f\162e\x73_\x67t\163\137\142\141\x64\x67\x65\137\143o\156t\141i\x6e\145\x72\137\143\163s");
        } elseif ($this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\151\144") != null && $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\x69\144") != "") {
            ${$this->x8a->x265->{$this->xdd->x265->{$this->x8a->x265->{$this->xdd->x265->x418}}}} = $orderModel->{$this->x8a->x265->x733}($this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("id"));
            ${$this->xdd->x2a4->{$this->x15->x2a4->x2011}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\x67\157\157gle\x74\x72us\164e\x64\x73\x74\x6f\162e\163_\147ts_\157r\144\145\162\x73\137eta\137s\150ip");
            ${$this->x15->x282->{$this->x8a->x282->xda8}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\x6f\x6fg\154\x65tru\x73t\145\x64\163\x74\157\162\145\x73\x5fg\164s\137\x6f\162\x64e\x72s\x5fet\x61");
            ${$this->x15->x287->x170e} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\157\157\x67\154e\x74ru\163\x74\145\x64\163\164\x6f\162es_\x67\164\x73\x5f\157r\x64\145r\163\x5f\x75s\145\137\x65\144\144\x5f\155\x6f\x64u\x6ce");
            ${$this->x15->x282->{$this->x15->x282->{$this->xdd->x282->xdbd}}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\x6f\157\x67\x6c\145\164\x72\165\x73\x74e\144\x73\x74o\162e\x73\x5f\x67ts\x5f\x67\x73\137\x70\162\x6f\144u\x63t\x5f\151\144");
            ${$this->xdd->x287->{$this->xdd->x287->x1722}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\x6fo\x67l\145\x74\x72\x75s\x74\145\x64\x73\x74o\162\145s\x5fg\164\x73\137\x63\157\165\x6etry");
            ${$this->x8a->x2a4->x2031} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\x67oog\x6c\x65t\162u\x73te\x64\x73tores\137\x67\x74\x73\137\147\164\163\137\151\144");
            ${$this->xdd->x282->xdd4} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\x6f\x6f\147\154\x65\164r\x75\163\164\x65dstor\145s\x5fgt\163\x5f\142adg\145\x5f\x70\x6f\163\x69ti\157\156");
            ${$this->x8a->x287->x173b} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147o\x6f\147l\x65\164ru\x73\164\x65d\x73\164\x6fr\145s\137g\x74s\x5f\154\x61n\x67\165\x61ge");
            ${$this->x15->x265->{$this->x8a->x265->x469}} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("g\157\x6f\x67letr\x75st\145\x64s\x74\157re\163_g\164\x73_\x67\142\x5f\151\x64");
            ${$this->x8a->x265->x46d} = $this->{$this->x15->x265->x705}()->{$this->x15->x265->x70b}("\147\x6f\157\147\x6c\x65\x74\x72\x75\163t\x65\x64st\157\162\145\163_\147\x74\x73\137b\141\x64\x67e\137\x63\157n\164ain\x65\x72\x5f\143s\x73");
        } if (${$this->x15->x287->{$this->xdd->x287->{$this->xdd->x287->{$this->xdd->x287->x16ee}}}} == null || ${$this->x15->x2a4->x2004}->{$this->xdd->x265->x9ff}() == null) {
            $this->{$this->xdd->x265->{$this->x8a->x265->{$this->x15->x265->{$this->x8a->x265->x3b8}}}} = __("\x55\x6e\141\142\x6ce\40\164\157\40\x6co\141d\x20\164\x68e\x20\x6frd\x65r");
            return;
        } ${$this->xdd->x2a4->{$this->x15->x2a4->x205f}} = $x11c($this->_storeManager->{$this->x8a->x265->x64b}()->{$this->xdd->x265->xa1b}());
        $this->{$this->x8a->x265->{$this->xdd->x265->{$this->x15->x265->{$this->x15->x265->x2d1}}}} = ${$this->x15->x282->{$this->x15->x282->{$this->xdd->x282->{$this->xdd->x282->xe06}}}}["h\157\163t"];
        $this->{$this->x8a->x265->{$this->xdd->x265->{$this->x8a->x265->x2e0}}} = ${$this->x15->x287->{$this->xdd->x287->{$this->xdd->x287->x16eb}}}->{$this->xdd->x265->xa2a}();
        ${$this->x15->x287->{$this->xdd->x287->x1768}} = "";
        if (${$this->x8a->x265->{$this->x8a->x265->{$this->x15->x265->{$this->x8a->x265->x486}}}} = ${$this->xdd->x2a4->{$this->x15->x2a4->x2008}}->{$this->x8a->x265->xa3f}()) {
            $this->{$this->x8a->x282->xc8e} = ${$this->x15->x2a4->{$this->xdd->x2a4->{$this->x8a->x2a4->x2069}}}->{$this->x15->x265->xa49}();
        } else {
            $this->{$this->x8a->x282->xc8e} = ${$this->x15->x265->x410}->{$this->x15->x265->xa53}()->{$this->x15->x265->xa49}();
        } $this->{$this->xdd->x282->xc92} = ${$this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->xd99}}}->{$this->xdd->x265->xa65}();
        $this->{$this->x15->x282->xc9e} = $x1c5("%\x30\61\56\62F", ${$this->x15->x287->{$this->xdd->x287->{$this->xdd->x287->x16eb}}}->{$this->xdd->x265->xa79}());
        $this->{$this->x8a->x282->xca8} = $x1c5("\45\x30\61.\62F", ${$this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->xd99}}}->{$this->x15->x265->xa87}());
        $this->{$this->x8a->x282->{$this->x8a->x282->xcb5}} = $x1c5("%\x30\61\x2e\62F", ${$this->x15->x2a4->x2004}->{$this->xdd->x265->xa9a}());
        $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x325}}}} = $x1c5("\45\x30\61\x2e\62\x46", ${$this->x15->x287->{$this->xdd->x287->x16ea}}->{$this->x15->x265->xaad}());
        ${$this->x8a->x2a4->{$this->x15->x2a4->x206e}} = new \Datetime();
        ${$this->xdd->x2a4->x206d}->{$this->x15->x265->xac1}($x175(${$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->x417}}}->{$this->xdd->x265->xac9}()));
        ${$this->x8a->x265->{$this->x8a->x265->{$this->x15->x265->x49a}}} = ${$this->x8a->x287->{$this->x15->x287->{$this->x8a->x287->{$this->x8a->x287->{$this->xdd->x287->x16fd}}}}};
        if (${$this->x8a->x287->{$this->x8a->x287->{$this->x15->x287->{$this->x8a->x287->x1787}}}} != "" && ${$this->xdd->x2a4->{$this->xdd->x2a4->{$this->x15->x2a4->{$this->x8a->x2a4->{$this->x8a->x2a4->x2079}}}}} > 0) {
            ${$this->x15->x265->{$this->xdd->x265->x48f}}->{$this->x15->x265->xad9}(new \DateInterval("P" . ${$this->xdd->x282->{$this->xdd->x282->{$this->x15->x282->xe27}}} . "\104"));
        } $this->{$this->x15->x282->xcc1} = ${$this->x15->x282->{$this->x8a->x282->xe14}}->{$this->x8a->x265->xae6}("Y\55m\55d");
        ${$this->x15->x287->{$this->x15->x287->{$this->x8a->x287->{$this->x15->x287->x1779}}}} = new \Datetime();
        ${$this->x15->x282->{$this->x8a->x282->xe14}}->{$this->x15->x265->xac1}($x175(${$this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->xd99}}}->{$this->xdd->x265->xac9}()));
        ${$this->x8a->x287->x1781} = ${$this->x15->x282->{$this->x8a->x282->xda8}};
        if (${$this->x8a->x287->{$this->x8a->x287->{$this->x15->x287->{$this->x8a->x287->x1787}}}} != "" && ${$this->x8a->x265->{$this->x8a->x265->{$this->x15->x265->x49a}}} > 0) {
            ${$this->x15->x265->{$this->xdd->x265->{$this->x15->x265->x492}}}->{$this->x15->x265->xad9}(new \DateInterval("\120" . ${$this->xdd->x2a4->{$this->xdd->x2a4->x2075}} . "\104"));
        } $this->{$this->x15->x265->{$this->x15->x265->{$this->xdd->x265->x339}}} = ${$this->x15->x282->{$this->x15->x282->{$this->xdd->x282->xe17}}}->{$this->x8a->x265->xae6}("\131\55\155\55\x64");
        ${$this->x8a->x265->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->x4b2}}}} = ${$this->x8a->x287->x16e8}->{$this->x15->x265->xb35}();
        $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->x34a}}} = "N";
        foreach (${$this->xdd->x2a4->{$this->x15->x2a4->{$this->x15->x2a4->{$this->xdd->x2a4->x2084}}}} as ${$this->x8a->x2a4->{$this->x15->x2a4->{$this->x8a->x2a4->x2093}}}) {
            if (${$this->x15->x282->{$this->x8a->x282->{$this->x15->x282->xe39}}}->{$this->x8a->x265->xb3d}() > 0) {
                $this->{$this->x8a->x265->{$this->x15->x265->x346}} = "Y";
                break;
            }
        } $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x358}}}} = "\x4e";
        foreach (${$this->xdd->x282->{$this->x8a->x282->{$this->x15->x282->{$this->x8a->x282->xe32}}}} as ${$this->x8a->x2a4->x208b}) {
            if (${$this->x15->x265->x4b5}->{$this->x8a->x265->xb45}() > 0) {
                $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x358}}}} = "\x59";
                break;
            }
        } $this->{$this->xdd->x265->{$this->x8a->x265->{$this->x15->x265->x2b0}}} = [];
        foreach (${$this->x8a->x265->{$this->x8a->x265->{$this->x8a->x265->x4ae}}} as ${$this->x8a->x2a4->x208b}) {
            ${$this->x15->x287->{$this->x8a->x287->x17a4}} = [ "\x6e\x61\155e" => $this->{$this->x8a->x265->xb52}(${$this->x8a->x2a4->{$this->x8a->x2a4->x208f}}->{$this->x8a->x265->xb5c}()), "p\x72\151\143e" => $x1c5("%\x30\61.\62\x46", ${$this->xdd->x265->{$this->x15->x265->x4b6}}->{$this->x8a->x265->xb73}()), "\161\x74\x79\x5f\157rde\162\145d" => $x1c1($x1c5(${$this->xdd->x265->{$this->x15->x265->x4b6}}->{$this->xdd->x265->xb82}() ? "%\x46" : "\x25\144", ${$this->x8a->x2a4->x208b}->{$this->x8a->x265->xb8c}()), 0, "\56", ""),];
            if (${$this->x15->x287->{$this->xdd->x287->x179d}}->{$this->xdd->x265->xba5}("\x70\x72\157\x64\165\x63\164\x5ft\x79\x70e") == "c\157nfigu\162\x61\x62\x6c\145") {
                ${$this->xdd->x2a4->{$this->x8a->x2a4->x20a5}} = $x1d8(${$this->x15->x282->{$this->x8a->x282->{$this->xdd->x282->{$this->x15->x282->xe3b}}}}->{$this->xdd->x265->xba5}("\160\162\x6f\x64\x75\143\164_\157pt\x69o\156\163"));
                ${$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x4c3}}}["\163\151\155\160\154\145\x5f\x73\x6b\165"] = ${$this->xdd->x282->{$this->x15->x282->{$this->x15->x282->xe51}}}["\163i\x6dp\154e\x5fsk\165"];
                ${$this->xdd->x265->{$this->xdd->x265->x4bf}}["\156\x61m\x65"] = ${$this->xdd->x287->{$this->xdd->x287->x17ac}}["simp\x6c\145\137\156a\x6de"];
                ${$this->x15->x2a4->{$this->xdd->x2a4->{$this->x8a->x2a4->x2099}}}["\x70\162\x6f\144\x75\143\164_\x69\144"] = $this->{$this->x15->x282->xcf0}->{$this->xdd->x265->xbc5}(${$this->x15->x265->x4ba}["\x73\151\155\160\154e\x5f\x73k\x75"])->{$this->xdd->x265->xbd6}();
            } else {
                ${$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x4c3}}}["\x70\162o\144\x75c\164\x5fid"] = ${$this->x8a->x282->xe35}->{$this->x8a->x265->xbe4}();
            } ${$this->x15->x287->{$this->x8a->x287->x17a4}}["\x67o\x6fgle\137sho\160\160\151\156\147"] = [ "g\x62as\x65\x5fac\143\157\165\156\164\x5fi\x64" => ${$this->x15->x282->{$this->x8a->x282->{$this->x15->x282->{$this->xdd->x282->xdf1}}}}, "\147\x62\141\x73e_\x63oun\164\x72\171" => ${$this->x15->x265->{$this->xdd->x265->x437}}, "\x67ba\x73e\x5fla\156\147\x75ag\145" => ${$this->x15->x287->{$this->x8a->x287->x173f}}, "\x67ba\x73\145\x5f\x69\x64" => -1];
            $this->{$this->xdd->x265->{$this->x8a->x265->{$this->x15->x265->x2b0}}}[${$this->x15->x265->x4ba}["p\162\157\x64u\143\x74\137\151\x64"]] = ${$this->xdd->x287->x17a0};
        } ${$this->x8a->x287->x17b7} = $this->{$this->x15->x265->{$this->xdd->x265->x373}}->{$this->xdd->x265->xbfc}()->{$this->x8a->x265->xc09}([${$this->x15->x282->{$this->xdd->x282->xdb8}}], true)->{$this->xdd->x265->xc14}("\x65\156\164i\x74\x79\137\151\x64", ["\151\156" => $x20f($this->{$this->xdd->x265->{$this->x8a->x265->{$this->x15->x265->x2b0}}})]);
        ${$this->xdd->x2a4->x20b7} = $this->{$this->x8a->x282->{$this->x15->x282->xd2b}}->{$this->x8a->x265->xc25}("g\145t\137" . ${$this->xdd->x2a4->{$this->x8a->x2a4->x2027}});
        foreach (${$this->x8a->x282->{$this->x8a->x282->{$this->x8a->x282->xe57}}} as ${$this->x8a->x2a4->{$this->xdd->x2a4->x20c3}}) {
            $this->{$this->xdd->x282->xc5c}[${$this->x8a->x2a4->{$this->x15->x2a4->{$this->x15->x2a4->{$this->x15->x2a4->x20cc}}}}->{$this->xdd->x265->xbd6}()]["\x67\157\157\x67le\x5f\x73hopp\x69\x6e\147"]['gbase_id'] = ${$this->xdd->x282->{$this->x8a->x282->xe6e}}->${$this->x8a->x265->{$this->xdd->x265->{$this->x15->x265->x4db}}}();
        } $this->{$this->x15->x265->{$this->xdd->x265->x2b9}} = ${$this->xdd->x2a4->{$this->x15->x2a4->{$this->xdd->x2a4->{$this->xdd->x2a4->x200e}}}};
    }

    public function isFrontendTest() {
        return $this->{$this->x8a->x282->{$this->x8a->x282->xcea}}->{$this->x15->x265->xc4b}("gt\163\137\164\x65\x73t_\x6frd\145\x72");
    }

    public function getItems() {
        return $this->{$this->xdd->x265->{$this->x15->x265->x2ab}};
    }

    public function getOrder() {
        return $this->{$this->x15->x265->{$this->xdd->x265->{$this->x15->x265->x2be}}};
    }

    public function getDomain() {
        return $this->{$this->x8a->x265->{$this->x8a->x265->x2cb}};
    }

    public function getEmail() {
        return $this->{$this->x8a->x265->{$this->xdd->x265->{$this->x8a->x265->x2e0}}};
    }

    public function getCountry() {
        return $this->{$this->x8a->x282->xc8e};
    }

    public function getCurrencyCode() {
        return $this->{$this->xdd->x265->{$this->x8a->x265->x2f7}};
    }

    public function getOrderTotal() {
        return $this->{$this->x8a->x265->{$this->x8a->x265->x300}};
    }

    public function getOrderDiscount() {
        return $this->{$this->x8a->x282->xca8};
    }

    public function getOrderShipping() {
        return $this->{$this->x15->x265->{$this->x8a->x265->x313}};
    }

    public function getOrderTax() {
        return $this->{$this->x8a->x265->{$this->xdd->x265->x31b}};
    }

    public function getShipDate() {
        return $this->{$this->x15->x282->xcc1};
    }

    public function getDeliveryDate() {
        return $this->{$this->x15->x265->{$this->x15->x265->{$this->x15->x265->{$this->x15->x265->x33e}}}};
    }

    public function getHasPreorder() {
        return $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->x34a}}};
    }

    public function getHasDigital() {
        return $this->{$this->x8a->x265->{$this->xdd->x265->{$this->xdd->x265->{$this->xdd->x265->x358}}}};
    }

}
