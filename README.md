#ConfigureTech Configurator for extension for Magento 2

Configurator enables merchant on Magento 2 to integrate with ConfigureTech API in minutes.

## Dependencies


## Installation


```composer require ctech/configurator```

Run upgrade scripts
```php bin/magento module:enable Ctech_Configurator```

```php bin/magento setup:upgrade```

```php bin/magento setup:di:compile```

in case you was in production mode , run this command 
```php bin/magento setup:static-content:deploy```


## Configuration

In your magento admin, go to Stores->Configuration->Sales->Payment Methods

"Hosted Settings" refers to credentials for both Bank and Card payments.

For invoice and payment plan, make sure your Svea account's country the allowed country in Magento.
