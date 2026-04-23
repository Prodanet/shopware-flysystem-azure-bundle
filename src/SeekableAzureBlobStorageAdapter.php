<?php

namespace Prodanet\ShopwareFlysystemAzureBundle;

use AzureOss\Storage\Blob\BlobServiceClient;
use AzureOss\Storage\BlobFlysystem\AzureBlobStorageAdapter;

class SeekableAzureBlobStorageAdapter extends AzureBlobStorageAdapter
{
    public function __construct(
        private BlobServiceClient $client,
        private string $container,
    ) {
        parent::__construct($client, $container);
    }

    /**
     * Blob streams returned by the Azure Flysystem implementation are not "seekable" (e.g. using fseek). This method
     * copies the parent's stream to a new, seekable stream and returns it instead.
     */
    public function readStream(string $path)
    {
        $seekableStream = tmpfile();
        $originalStream = parent::readStream($path);
        stream_copy_to_stream($originalStream, $seekableStream);
        rewind($seekableStream);
        return $seekableStream;
    }
}
