<?php
namespace Techm\Ankita\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Products implements ResolverInterface
{

    private $productsDataProvider;

    /**
     * @param DataProvider\Products $productsRepository
     */
    public function __construct(
        \Techm\Ankita\Model\Resolver\DataProvider\Products $productsDataProvider
    ) {
        $this->productsDataProvider = $productsDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
		
		$sku = $this->getSku($args);
        $productsData = $this->productsDataProvider->getAttributesBySku($sku); 
        return $productsData;        
    }
	private function getSku(array $args)
    {
        if (!isset($args['sku'])) {
            throw new GraphQlInputException(__('SKU should be specified'));
        }
        return $args['sku'];
    }
}

