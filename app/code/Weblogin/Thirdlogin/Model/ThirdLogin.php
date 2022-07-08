<?php
namespace Weblogin\Thirdlogin\Model;

class ThirdLogin
{
    /**
     * {@inheritdoc}
     */
    public function getCustomerInfo($email)
    {
        $res = [
            'code' => 200,
            'message' => '',
            'data' => []
        ];

        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $conn = $om->get('Magento\Framework\App\ResourceConnection')->getConnection();
        $table = $conn->getTableName('customer_entity');
        $fields = ["entity_id","email","created_at"];

        // 使用SqlBuilder查询数据库
        $select = $conn->select()
            ->from($table,$fields)
            ->where('email = ?', $email);
            
        $customerInfo = $conn->fetchAll($select);

        if(empty($customerInfo)){
            $res['code'] = 10001;
            $res['message'] = 'customer not exists.';
            exit(json_encode($res));
        }

        $customer = $customerInfo[0];
        $res['data'] = $customer;

        exit(json_encode($res));
    }
    
}