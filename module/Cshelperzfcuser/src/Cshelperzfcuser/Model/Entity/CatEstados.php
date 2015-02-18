<?php

namespace Cshelperzfcuser\Model\Entity;

class CatEstados implements CatEstadosInterface {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return CatEstadosInterface
     */
    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return CatEstadosInterface
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

}
