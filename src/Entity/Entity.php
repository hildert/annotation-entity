<?php

namespace Hildert\Entity;

use Hildert\Column\Column;
use Hildert\EntityAnnotationReader;
use ReflectionObject;
use ReflectionProperty;
use Zend\Hydrator\ObjectProperty as Hydrator;

class Entity
{

    /**
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     *
     * @param array $data
     */
    public function exchangeArray($data)
    {
        if (!is_array($data)) {
            return;
        }
        $annotationReader = EntityAnnotationReader::getInstance();
        $properties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        /**
         * convert name
         */
        foreach($properties as $property) {
            /**
             * @var Column $column
             */
            $column = $annotationReader->getPropertyAnnotation($property, 'Hildert\Column\Column');
            if (isset($column)) {
                if (array_key_exists($column->name, $data)) {
                    $data[$property->name] = $data[$column->name];
                    unset($data[$column->name]);
                }
            }
        }
        $this->getHydrator()->hydrate($data, $this);
    }

    /**
     *
     * @return array()
     */
    public function getArrayCopy()
    {
        $data = $this->getHydrator()->extract($this);
        $annotationReader = EntityAnnotationReader::getInstance();;
        $properties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        /**
         * convert name
         */
        foreach($properties as $property) {
            /**
             * @var Column $column
             */
            $column = $annotationReader->getPropertyAnnotation($property, 'Hildert\Column\Column');
            if (isset($column)) {
                if (array_key_exists($property->name, $data)) {
                    $data[$column->name] = $data[$property->name];
                    unset($data[$property->name]);
                }
            }
        }
        return $data;
    }

    /**
     * @param Hydrator $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return Hydrator
     */
    public function getHydrator()
    {
        if (!isset($this->hydrator)) {
            $this->hydrator = new Hydrator();
        }
        return $this->hydrator;
    }
}