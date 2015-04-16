<?php

namespace Cshelperzfcuser\Model\Entity;

interface CatEstadosInterface {

    /**
     * Get estadoId.
     *
     * @return int
     */
    public function getEstadoId();

    /**
     * Set estadoId.
     *
     * @param int $estadoId
     * @return CatEstadosInterface
     */
    public function setEstadoId($estadoId);

    /**
     * Get estado.
     *
     * @return string
     */
    public function getEstado();

    /**
     * Set estado.
     *
     * @param string $estado
     * @return CatEstadosInterface
     */
    public function setEstado($estado);
}
