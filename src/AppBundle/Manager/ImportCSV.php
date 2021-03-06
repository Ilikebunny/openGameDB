<?php

namespace AppBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportCSV {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Get csv directory
     *
     */
    private function getDirectoryData() {
        $root = $this->container->getParameter('kernel.root_dir');
        $root .= "/data/";
        return $root;
    }

    /**
     * Test import
     *
     */
    public function CSV_to_array($filename) {
        $row = 1;
        $csvDirectory = $this->getDirectoryData();
        $csvContent = array();
        if (($handle = fopen($csvDirectory . $filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                $data = array_map("utf8_encode", $data); //force UTF8
                $csvContent[$row] = $data;
                $row++;
            }
            fclose($handle);
        }
        return $csvContent;
    }

    /**
     * Get file content to string
     *
     */
    public function TXT_to_String($filename) {
        $csvDirectory = $this->getDirectoryData();
        $content = file_get_contents($csvDirectory . $filename);
        $content = utf8_encode($content);
        return $content;
    }

}
