<?php
namespace Partner\Brands\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Brands extends AbstractDb
{
    /**
     * 初始化 resource model
     */
    protected function _construct()
    {
        // 指定表名和主键
        $this->_init('brands', 'id');
    }

}