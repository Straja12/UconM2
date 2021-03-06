<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BeeIt\EmailNotification\Model\ResourceModel;

/**
 * Product alert for back in abstract resource model
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
abstract class AbstractResource extends \Magento\ProductAlert\Model\ResourceModel\AbstractResource
{
    /**
     * Retrieve alert row by object parameters
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return array|false
     */
    protected function _getAlertRow(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();
        if ($object->getCustomerEmail() && $object->getProductId() && $object->getWebsiteId()) {
            $select = $connection->select()->from(
                $this->getMainTable()
            )->where(
                'customer_email = :customer_email'
            )->where(
                'product_id  = :product_id'
            )->where(
                'website_id  = :website_id'
            );
            $bind = [
                ':customer_email' => $object->getCustomerEmail(),
                ':product_id' => $object->getProductId(),
                ':website_id' => $object->getWebsiteId(),
            ];
            return $connection->fetchRow($select, $bind);
        }
        return false;
    }

    /**
     * Delete all customer alerts on website
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param string $customerId
     * @param int $websiteId
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function deleteCustomer(\Magento\Framework\Model\AbstractModel $object, $customerEmail, $websiteId = null)
    {
        $connection = $this->getConnection();
        $where = [];
        $where[] = $connection->quoteInto('customer_email=?', $customerEmail);
        if ($websiteId) {
            $where[] = $connection->quoteInto('website_id=?', $websiteId);
        }
        $connection->delete($this->getMainTable(), $where);
        return $this;
    }
}
