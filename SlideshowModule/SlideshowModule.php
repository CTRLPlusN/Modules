<?php

namespace CTRLPlusN\Modules\SlideshowModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\Serializer\SerializerBuilder;
use CTRLPlusN\Modules\SlideshowModule\Model\Slideshow;

class SlideshowModule {

    const FILE = 'settings-slideshow.json';
    const LOC_PATH = "@CTRLPlusN/Resources/json";

    /**
     * ContainerInterface
     */
    protected $container;

    /**
     * ObjectManager
     */
    protected $em;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function loadConfiguration() {
        try {
            $this->container->get('components.file_finder')->find('@CTRLPlusN/Resources/json', 'settings-slideshow.json');
            $jsonDatas = $this->container->get('components.file_finder')->getContent();
            $serializer = SerializerBuilder::create()->build();
            return $serializer->deserialize($jsonDatas, Slideshow::class, 'json');
        } catch (\Exception $e) {
            return new Slideshow();
        }
    }

    public function saveConfiguration($dataform) {
        $serializer = SerializerBuilder::create()->build();
        $jsonobj = $serializer->serialize($dataform, 'json');
        // Génération du fichier JSON
        $this->container->get('components.file_dumper')->dumpFile($jsonobj, 'settings-slideshow.json', "../src/CTRLPlusN/Resources/json");
        return;
    }

}
