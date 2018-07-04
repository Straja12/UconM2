<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BeeIt\EmailNotification\Model\ResourceModel\Stock;

/**
 * Product alert for back in stock collection
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 *
 * @api
 * @since 100.0.2
 */
class Collection extends \Magento\ProductAlert\Model\ResourceModel\Stock\Collection
{
    /**
     * Set order by customer
     *
     * @param string $sort
     * @return $this
     */
    public function setCustomerOrder($sort = 'ASC')
    {
        $this->getSelect()->order('customer_email ' . $sort);
        return $this;
    }
}
