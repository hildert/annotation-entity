<?php
namespace Hildert;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class EntityAnnotationReader
{
    protected static $instance;

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            AnnotationRegistry::registerFile(__DIR__ . '/Column/Column.php');
            self::$instance = new AnnotationReader();
        }
        return self::$instance;
    }
}