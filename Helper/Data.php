<?php

namespace Kaushikofficial\Outofstocklast\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
    }

    public function isModuleEnabled()
    {
        return $this->_scopeConfig->getValue('outofstocklast/kaushik_outofstocklast/active', $this->_storeScope);
    }
}
