<?php

namespace Uploader\Model\Entity;

class ModArchivos implements ModArchivosInterface {

    /**
     * @var int
     */
    protected $archivosId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var int
     */
    protected $fechaCreacion;

    /**
     * @var int
     */
    protected $estatus;

    /**
     * Get archivosId.
     *
     * @return int
     */
    public function getArchivosId() {
        return $this->archivosId;
    }

    /**
     * Set archivosId.
     *
     * @param int $archivosId
     * @return ModArchivosInterface
     */
    public function setArchivosId($archivosId) {
        $this->archivosId = (int) $archivosId;
        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     * @return ModArchivosInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     * @return ModArchivosInterface
     */
    public function setName($name) {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename() {
        return $this->filename;
    }

    /**
     * Set filename.
     *
     * @param string $filename
     * @return ModArchivosInterface
     */
    public function setFilename($filename) {
        $this->filename = (string) $filename;
        return $this;
    }

    /**
     * Get fechaCreacion.
     *
     * @return int
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaCreacion.
     *
     * @param int $fechaCreacion
     * @return ModArchivosInterface
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = (int) $fechaCreacion;
        return $this;
    }

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus() {
        return $this->estatus;
    }

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return ModArchivosInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
