<?php

namespace Cshelperzfcuser\Model\Entity;

class CatEstados implements CatEstadosInterface {

    /**
     * @var int
     */
    protected $estadoId;

    /**
     * @var string
     */
    protected $estado;

    /**
     * Get estadoId.
     *
     * @return int
     */
    public function getEstadoId() {
        return $this->estadoId;
    }

    /**
     * Set estadoId.
     *
     * @param int $estadoId
     * @return CatEstadosInterface
     */
    public function setEstadoId($estadoId) {
        $this->estadoId = (int) $estadoId;
        return $this;
    }

    /**
     * Get estado.
     *
     * @return string
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set estado.
     *
     * @param string $estado
     * @return CatEstadosInterface
     */
    public function setEstado($estado) {
        $this->estado = (string) $estado;
        return $this;
    }

}
