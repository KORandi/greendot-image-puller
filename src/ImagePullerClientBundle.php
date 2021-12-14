<?php
namespace Greendot\ImagePullerClient;

use Greendot\ImagePullerClient\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Yaml\Yaml;

/**
 * ImagePullerClient
 */
class ImagePullerClientBundle extends Bundle {

    private string $projectRoot;

    public function __construct(string $projectRoot)
    {
        $this->projectRoot = $projectRoot;
    }

//    public function build(ContainerBuilder $container)
//    {
//        parent::build($container);
//        $processor = new Processor();
//        $configuration = new Configuration();
//        $processedConfigs[] = $processor->processConfiguration($configuration, []);
//        $this->saveIntoYAML($processedConfigs);
//    }
//
//    private function saveIntoYAML(array $array)
//    {
//        $yaml = Yaml::dump($array);
//        $configPath = "/config/packages/image_puller_client.yaml";
//        if (!file_exists($configPath)) {
//            file_put_contents($this->projectRoot.$configPath, $yaml);
//        }
//    }
}