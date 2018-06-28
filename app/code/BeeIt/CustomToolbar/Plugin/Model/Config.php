<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 6/26/2018
 * Time: 10:36 AM
 */
namespace BeeIt\CustomToolbar\Plugin\Model;
use Magento\Store\Model\StoreManagerInterface;
class Config
{
    protected $_storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;

    }

    /**
     * Adding custom options and changing labels
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @param [] $options
     * @return []
     */
    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $catalogConfig, $options)
    {
        $options['stock'] = __('Stock');
        return $options;

    }
}