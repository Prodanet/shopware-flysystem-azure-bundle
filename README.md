This package started as a fork of https://github.com/TorqIT/shopware-flysystem-azure-bundle but as league/flysystem-azure-blob-storage is an abandoned library and the author of the library does not seem to be active, recomendations from '[Packagist](https://packagist.org/)' is to use the package azure-oss/storage-blob-flysystem.

This package enables Shopware to write to an Azure Storage Account via Flysystem. It acts as a wrapper around https://github.com/Azure-OSS/azure-storage-php-adapter-flysystem. To install:

1. Run `composer require prodanet/shopware-flysystem-azure-bundle`
2. Register the bundle by adding it to your project's `bundles.php` file:
    ```php
   <?php
   return [
      ...
      Prodanet\ShopwareFlysystemAzureBundle\ProdanetShopwareFlysystemAzureBundle::class => ['all' => true]
   ];
3. Add the contents of the file `shopware_example.yaml` to your project's `shopware.yaml` file (typically located at `config/packages/shopware.yaml`), adjusting the environment variables as necessary.
