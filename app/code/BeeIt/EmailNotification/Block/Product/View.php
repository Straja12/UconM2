<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BeeIt\EmailNotification\Block\Product;
/**
 * Product view price and stock alerts
 */
class View extends \Magento\ProductAlert\Block\Product\View
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * Helper instance
     *
     * @var \Magento\ProductAlert\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $coreHelper;

    /**
     * @var  \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\ProductAlert\Helper\Data $helper
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\Helper\PostHelper $coreHelper
     * @param \Magento\Customer\Model\Session $session
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\ProductAlert\Helper\Data $helper,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\Helper\PostHelper $coreHelper,
        \Magento\Customer\Model\Session $session,
        array $data = []
    ) {
        parent::__construct($context,$helper,$registry,$coreHelper, $data);
        $this->_session = $session;
    }

    public function isCustomerLoggedIn(){

        return $this->_session->isLoggedIn();
    }


}
