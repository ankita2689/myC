# Mage2 Module Techm Ankita

    ``techm/module-ankita``

## Main Functionalities
create custom product attribute

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Techm`
 - Enable the module by running `php bin/magento module:enable Techm_Ankita`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require techm/module-ankita`
 - enable the module by running `php bin/magento module:enable Techm_Ankita`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Specifications

 - GraphQl Endpoint
	- Products


## Attributes

 - Product - product type (prod_type)

