<?php

namespace Techm\Ankita\Model\Product\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ProdType extends AbstractSource
{
	/**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
       return [
            ['value' => '0', 'label' => __('New')],
            ['value' => '1', 'label' => __('Sale')],
            ['value' => '2', 'label' => __('Exclusive')]
        ];        
    }
}

