<?php

namespace Uploader\Model\Entity;

interface ModArchivosInterface {

    /**
     * Get archivosId.
     *
     * @return int
     */
    public function getArchivosId();

    /**
     * Set archivosId.
     *
     * @param int $archivosId
     * @return ModArchivosInterface
     */
    public function setArchivosId($archivosId);

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId();

    /**
     * Set userId.
     *
     * @param int $userId
     * @return ModArchivosInterface
     */
    public function setUserId($userId);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return ModArchivosInterface
     */
    public function setName($name);

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename();

    /**
     * Set filename.
     *
     * @param string $filename
     * @return ModArchivosInterface
     */
    public function setFilename($filename);

    /**
     * Get fechaCreacion.
     *
     * @return int
     */
    public function getFechaCreacion();

    /**
     * Set fechaCreacion.
     *
     * @param int $fechaCreacion
     * @return ModArchivosInterface
     */
    public function setFechaCreacion($fechaCreacion);

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus();

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return ModArchivosInterface
     */
    public function setEstatus($estatus);
}
