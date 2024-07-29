<?php

namespace Techm\Ankita\Model\Resolver\DataProvider;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\ProductRepository;

class Products extends Template
{
    /**
    * @var ProductRepository
    */
    protected $_productRepository;
 
    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        array $data = []
        )
    {
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }
	
	/**
     *  this function return product attribute prod_type by product sku
     *
     * @param string $sku     
	 * @return array
     **/
	 public function getAttributesBySku(String $sku)
     {
        $_product = $this->_productRepository->get($sku);
        $attributes = $_product->getAttributes();// All Product Attributes
 
        $attributesData = [];      
        foreach ($attributes as $attribute) {
            if($attribute->getIsUserDefined()){              
                $attributeValue = $attribute->getFrontend()->getValue($_product); 
                if($attribute->getAttributeCode()=="prod_type"){                    
                    $attributesData['prod_type'] = $attributeValue;
                }
            }            
        }
        return $attributesData;
    }
}

