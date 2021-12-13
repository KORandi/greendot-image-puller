<?php
namespace Greendot\ImagePullerClient;

use Greendot\DependencyInjection\Compiler\ContextPass;
use Greendot\ImagePullerClient\DependencyInjection\ImagePullerExtension;
use Symfony\Component\Config\Resource\ClassExistenceResource;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * ImagePullerClient
 */
class ImagePullerClient extends Bundle {
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new ImagePullerExtension();
        }

        return $this->extension ?: null;
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }

}