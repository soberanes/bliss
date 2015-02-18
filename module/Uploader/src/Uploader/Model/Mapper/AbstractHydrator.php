<?php

namespace Uploader\Model\Mapper;

use Zend\Stdlib\Hydrator\ClassMethods;

class AbstractHydrator extends ClassMethods {

    private $interfaz;

    function __construct($interfaz) {
        parent::__construct();
        $this->interfaz = $interfaz;
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object) {
        if (!$object instanceof $this->interfaz) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }
        /* @var $object UserInterface */
        $data = parent::extract($object);
//        $data = $this->mapField('id', 'id', $data);
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object) {
        if (!$object instanceof $this->interfaz) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }
//        $data = $this->mapField('id', 'id', $data);
        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array) {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }

}
