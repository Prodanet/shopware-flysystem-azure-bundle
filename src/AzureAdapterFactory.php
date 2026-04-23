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
        $storageConnectionString = $config['storage_connection_string'];
        $storageAccountContainer = $config['storage_account_container'];
        $storagePreffix = $config['storage_prefix'] ?? '';
        $isPublicContainer = $config['storage_public'] ?? false;
        $service = BlobServiceClient::fromConnectionString($storageConnectionString);
        $container = $service->getContainerClient($storageAccountContainer);
        return new AzureBlobStorageAdapter(containerClient:$container, prefix:$storagePreffix, isPublicContainer:$isPublicContainer);
    }
}
