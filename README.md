#ConfigureTech Configurator for extension for Magento 2

Configurator enables merchant on Magento > 2.3 to integrate with ConfigureTech API in minutes.

## Dependencies
it works with Magento 2.3, for Magento 2.2 version , please check use : ```composer require ctech/configurator:2.2```

## Installation

```composer require ctech/configurator:2.3```

Run upgrade scripts
```php bin/magento module:enable Ctech_Configurator```

```php bin/magento setup:upgrade```

```php bin/magento setup:di:compile```

in case you was in production mode , run this command 
```php bin/magento setup:static-content:deploy```


## Configuration

In your magento admin, go to Stores->Configuration->Catalog->Ctech Configurator , you can enter your API key field 