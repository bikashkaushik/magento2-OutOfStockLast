<?php

namespace Kaushikofficial\Outofstocklast\Block\Product\ProductList;

class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Model\Config $catalogConfig,
        \Magento\Catalog\Model\Product\ProductList\Toolbar $toolbarModel,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Catalog\Helper\Product\ProductList $productListHelper,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Kaushikofficial\Outofstocklast\Helper\Data $dataHelper,
        array $data = []
    )
    {
        $this->dataHelper = $dataHelper;
        parent::__construct(
                        $context,
                        $catalogSession,
                        $catalogConfig,
                        $toolbarModel,
                        $urlEncoder,
                        $productListHelper,
                        $postDataHelper,
                        $data
                    );
    }

    /**
     * Set collection to pager
     *
     * @param \Magento\Framework\Data\Collection $collection
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->_collection = $collection;

        $this->_collection->setCurPage($this->getCurrentPage());

        // we need to set pagination only if passed value integer and more that 0
        $limit = (int)$this->getLimit();
        if ($limit) {
            $this->_collection->setPageSize($limit);
        }

        if ($this->dataHelper->isModuleEnabled()) {
            $collection->getSelect()->order("stock_status DESC");
        }

        if ($this->getCurrentOrder()) {
            if ($this->getCurrentOrder() == 'position') {
                $this->_collection->addAttributeToSort(
                    $this->getCurrentOrder(),
                    $this->getCurrentDirection()
                )->addAttributeToSort('entity_id', $this->getCurrentDirection());
            } else {
                $this->_collection->setOrder($this->getCurrentOrder(), $this->getCurrentDirection());
            }
        }

        return $this;
    }
}
