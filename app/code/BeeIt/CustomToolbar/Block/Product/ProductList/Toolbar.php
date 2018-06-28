<?php
namespace BeeIt\CustomToolbar\Block\Product\ProductList;
class Toolbar  extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    /**
     * Set collection to pager
     *
     * @param \Magento\Framework\Data\Collection $collection
     * @return $this
     */

    public function setCollection($collection) {

        $this->_collection = $collection;

        $this->_collection->setCurPage($this->getCurrentPage());

        // we need to set pagination only if passed value integer and more that 0
        $limit = (int)$this->getLimit();
        if ($limit) {
            $this->_collection->setPageSize($limit);
        }


        if ($this->getCurrentOrder()) {
            // Costruisco la custom query
            if ($this->getCurrentOrder() == 'stock') {
                if ( $this->getCurrentDirection() == 'asc' ) {
                $this->_collection->getSelect()
                    ->joinLeft(
                        'cataloginventory_stock_status',
                        'e.entity_id = cataloginventory_stock_status.product_id',
                        'cataloginventory_stock_status.qty AS quantity'
                    )
                    ->group('e.entity_id')
                    ->order('quantity ASC');
                } else{
                    $this->_collection->getSelect()
                        ->joinLeft(
                            'cataloginventory_stock_status',
                            'e.entity_id = cataloginventory_stock_status.product_id',
                            'cataloginventory_stock_status.qty AS quantity'
                        )
                        ->group('e.entity_id')
                        ->order('quantity DESC');
                }
            }   elseif ($this->getCurrentOrder() == 'position') {
                $this->_collection->addAttributeToSort(
                    $this->getCurrentOrder(),
                    $this->getCurrentDirection()
                )->addAttributeToSort('entity_id', $this->getCurrentDirection());

            }   else {
                $this->_collection
                    ->setOrder(
                        $this->getCurrentOrder(),
                        $this->getCurrentDirection()
                    );
            }
        }

        return $this;

    }
}