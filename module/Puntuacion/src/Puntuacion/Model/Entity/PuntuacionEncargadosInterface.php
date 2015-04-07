<?php

namespace Puntuacion\Model\Entity;

interface PuntuacionEncargadosInterface {

	/**
     * Get puntuacionEncargadosId.
     *
     * @return int
     */
    public function getPuntuacionEncargadosId();

    /**
     * Set puntuacionId.
     *
     * @param int $puntuacionEncargadosId
     * @return ModArchivosInterface
     */
    public function setPuntuacionEncargadosId($puntuacionEncargadosId);

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
     * Get mes.
     *
     * @return int
     */
    public function getMes();

    /**
     * Set mes.
     *
     * @param int $mes
     * @return ModArchivosInterface
     */
    public function setMes($mes);

    /**
     * Get puntos.
     *
     * @return float
     */
    public function getPuntos();

    /**
     * Set puntos.
     *
     * @param float $puntos
     * @return ModArchivosInterface
     */
    public function setPuntos($puntos);

    /**
     * Get regDate.
     *
     * @return int
     */
    public function getRegDate();

    /**
     * Set regDate.
     *
     * @param int $regDate
     * @return ModArchivosInterface
     */
    public function setRegDate($regDate);

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param int $status
     * @return ModArchivosInterface
     */
    public function setStatus($status);
}



