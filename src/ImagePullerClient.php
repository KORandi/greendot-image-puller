<?php
namespace Greendot\ImagePullerClient;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * ImagePullerClient
 */
class ImagePullerClient extends Bundle {
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new \ImagePullerExtension();
        }

        return $this->extension ?: null;
    }
}