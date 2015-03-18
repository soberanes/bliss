<?php

namespace Puntuacion\Model\Entity;

interface CuotaFamilyInterface {

    /**
     * Get cuotaId.
     *
     * @return int
     */
    public function getCuotaId();

    /**
     * Set cuotaId.
     *
     * @param int $cuotaId
     * @return ModArchivosInterface
     */
    public function setCuotaId($cuotaId);

    /**
     * Get usuarioId.
     *
     * @return int
     */
    public function getUsuarioId();

    /**
     * Set usuarioId.
     *
     * @param int $usuarioId
     * @return ModArchivosInterface
     */
    public function setUsuarioId($usuarioId);

    /**
     * Get familiaId.
     *
     * @return int
     */
    public function getFamiliaId();

    /**
     * Set familiaId.
     *
     * @param int $familiaId
     * @return ModArchivosInterface
     */
    public function setFamiliaId($familiaId);

    /**
     * Get familiaText.
     *
     * @return string
     */
    public function getFamiliaText();

    /**
     * Set familiaText.
     *
     * @param string $familiaText
     * @return ModArchivosInterface
     */
    public function setFamiliaText($familiaText);

    /**
     * Get cuota.
     *
     * @return float
     */
    public function getCuota();

    /**
     * Set cuota.
     *
     * @param float $cuota
     * @return ModArchivosInterface
     */
    public function setCuota($cuota);


    /**
     * Get venta.
     *
     * @return float
     */
    public function getVenta();

    /**
     * Set venta.
     *
     * @param float $venta
     * @return ModArchivosInterface
     */
    public function setVenta($venta);

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

}