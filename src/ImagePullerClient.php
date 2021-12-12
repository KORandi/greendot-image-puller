<?php
namespace Greendot\ImagePullerClient;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * ImagePullerClient
 */
class ImagePullerClient extends Bundle {
    public function load(array $configs, ContainerBuilder $containerBuilder) {
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load("routing.yaml");
    }
}