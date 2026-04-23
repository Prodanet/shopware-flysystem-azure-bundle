<?php

namespace Prodanet\ShopwareFlysystemAzureBundle;

use AzureOss\Storage\Blob\BlobServiceClient;
use AzureOss\Storage\BlobFlysystem\AzureBlobStorageAdapter;
use Shopware\Core\Framework\Adapter\Filesystem\Adapter\AdapterFactoryInterface;

class AzureAdapterFactory implements AdapterFactoryInterface
{
    public function getType(): string
    {
        return 'azure';
    }

    public function create(array $config): \League\Flysystem\FilesystemAdapter
    {
        $storageAccountName = $config['storage_account_name'];
        $storageAccountKey = $config['storage_account_key'];
        $storageAccountContainer = $config['storage_account_container'];
        $storagePreffix = $config['storage_prefix'] ?? '';
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=$storageAccountName;AccountKey=$storageAccountKey;EndpointSuffix=core.windows.net";
        $service = BlobServiceClient::fromConnectionString($connectionString);
        $container = $service->getContainerClient($storageAccountContainer);
        return new AzureBlobStorageAdapter($container, $storagePreffix);
    }
}
