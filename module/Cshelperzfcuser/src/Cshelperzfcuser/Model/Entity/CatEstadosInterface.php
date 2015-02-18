<?php

namespace Cshelperzfcuser\Model\Entity;

interface CatEstadosInterface {

    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     * @return CatEstadosInterface
     */
    public function setId($id);

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre();

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return CatEstadosInterface
     */
    public function setNombre($nombre);
}
