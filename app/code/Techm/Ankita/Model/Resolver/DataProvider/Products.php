<?php
namespace Techm\Ankita\Model\Resolver\DataProvider;

class Products extends \Magento\Framework\View\Element\Template
{

    protected $_productRepository;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = []
        )
    {
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }
	
	/**
     * @params string $sku
     * this function return product attribute prod_type by product sku
	 * @return array
     **/
	 public function getAttributesBySku(String $sku){
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

