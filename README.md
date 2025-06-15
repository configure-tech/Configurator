# ConfigureTech Configurator extension for Magento 2.\*

Configurator enable merchants on Magento2 to integrate with ConfigureTech API in minutes 🛍️.

It also comes with a product installer, so you can import your selected products from our API in no time 🚀.

## Supported Magento2 versions

We support:

- Magento 2.4.8 : please run : `composer require ctech/configurator:3.5.0`
- Magento 2.4.7 : please run : `composer require ctech/configurator:3.5.0`
- Magento 2.4.6 : please run : `composer require ctech/configurator:3.4.0`
- Magento 2.4.4 : please run : `composer require ctech/configurator:3.3.0`
- Magento 2.4 : please run : `composer require ctech/configurator:3.2.0`
- Magento 2.3.5-p1 : please run : `composer require ctech/configurator:3.1.0`
- Magento 2.3 : please run : `composer require ctech/configurator:2.3`
- Magento 2.2 : please run : `composer require ctech/configurator:2.2`

## Installation

you need to run the composer require that matches your magento version , for example
`composer require ctech/configurator:3.5.0`

Run upgrade scripts
`php bin/magento module:enable Ctech_Configurator`

`php bin/magento setup:upgrade`

`php bin/magento setup:di:compile`

in case you was in production mode , run this command to deploy static contents
`php bin/magento setup:static-content:deploy`

## Configuration

In your magento admin, go to Stores -> Configuration -> Catalog -> Ctech Configurator , you can enter your API key field
