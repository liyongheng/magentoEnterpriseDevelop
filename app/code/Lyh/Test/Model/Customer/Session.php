<?php
namespace Lyh\Test\Model\Customer;

class Session extends \Magento\Customer\Model\Session  //继承要重写的model，可能用到里面的方法
{
    public function getCustomerInfo($entity_id)
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //获取数据库连接实例
        $conn = $this->_objectManager->get('\Magento\Framework\App\ResourceConnection')->getConnection();
        $tbl = $conn->getTableName('customer_entity');
        //查询数据示例
        $select = $conn->select()
            ->from($tbl)
            ->where('entity_id =  ?', $entity_id);
        $res = $conn->fetchAll($select);
        return $res;
    }
}