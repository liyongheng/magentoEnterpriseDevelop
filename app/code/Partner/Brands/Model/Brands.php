<?php
namespace Partner\Brands\Model;

use \Magento\Framework\Model\AbstractModel;

class Brands extends AbstractModel
{
    //指定数据表主键字段名称
    protected $_idFieldName = 'id';

    /**
     * 初始化 resource model
     */
    protected function _construct()
    {
        $this->_init('Partner\Brands\Model\ResourceModel\Brands');
    }
}