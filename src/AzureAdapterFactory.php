<?php

namespace Prodanet\ShopwareFlysystemAzureBundle;

use AzureOss\Storage\Blob\BlobServiceClient;
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
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=$storageAccountName;AccountKey=$storageAccountKey;EndpointSuffix=core.windows.net";
        return new SeekableAzureBlobStorageAdapter(BlobServiceClient::fromConnectionString($connectionString), $storageAccountContainer);
    }
}
