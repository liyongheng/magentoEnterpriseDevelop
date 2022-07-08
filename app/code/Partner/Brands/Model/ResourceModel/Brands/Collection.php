<?php
namespace Partner\Brands\Model\ResourceModel\Brands;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'id';

    /**
     * 定义Resource Model
     */
    protected function _construct()
    {
        //参数为 model,resource model
        $this->_init('Partner\Brands\Model\Brands', 'Partner\Brands\Model\ResourceModel\Brands');
    }
}