<?php

namespace Lyh\Banner\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const TIMESALE_TEXT_START_DATE = 'extend_config_general/timesale/timesale_start_date';
    const TIMESALE_TEXT_END_DATE = 'extend_config_general/timesale/timesale_end_date';
    const TIMESALE_TEXT_START_TIME = 'extend_config_general/timesale/timesale_start_time';
    const TIMESALE_TEXT_END_TIME = 'extend_config_general/timesale/timesale_end_time';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * get homepage timesale date and time config
     * 
    */
    public function getTimeSaleConfig()
    {

        $startDateText = $this->getConfig(self::TIMESALE_TEXT_START_DATE);
        $endDateText = $this->getConfig(self::TIMESALE_TEXT_END_DATE);
        $startTime = $this->getConfig(self::TIMESALE_TEXT_START_TIME);
        $endTime = $this->getConfig(self::TIMESALE_TEXT_END_TIME);
        return [
            's_day' => $startDateText,
            's_time' => $startTime,
            'e_day' => $endDateText,
            'e_time' => $endTime
        ];

    }

}