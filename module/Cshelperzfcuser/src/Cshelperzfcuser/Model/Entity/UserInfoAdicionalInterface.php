<?php

namespace Cshelperzfcuser\Model\Entity;

interface UserInfoAdicionalInterface {

    /**
     * Get userInfoAdicionalId.
     *
     * @return int
     */
    public function getUserInfoAdicionalId();

    /**
     * Set userInfoAdicionalId.
     *
     * @param int $userInfoAdicionalId
     * @return UserInfoAdicionalInterface
     */
    public function setUserInfoAdicionalId($userInfoAdicionalId);

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
     * @return UserInfoAdicionalInterface
     */
    public function setUserId($userId);

    /**
     * Get direccion.
     *
     * @return string
     */
    public function getDireccion();

    /**
     * Set direccion.
     *
     * @param string $direccion
     * @return UserInfoAdicionalInterface
     */
    public function setDireccion($direccion);

    /**
     * Get ciudad.
     *
     * @return string
     */
    public function getCiudad();

    /**
     * Set ciudad.
     *
     * @param string $ciudad
     * @return UserInfoAdicionalInterface
     */
    public function setCiudad($ciudad);

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
     * @return UserInfoAdicionalInterface
     */
    public function setEstadoId($estadoId);

    /**
     * Get cp.
     *
     * @return int
     */
    public function getCp();

    /**
     * Set cp.
     *
     * @param int $cp
     * @return UserInfoAdicionalInterface
     */
    public function setCp($cp);

    /**
     * Get telefono.
     *
     * @return int
     */
    public function getTelefono();

    /**
     * Set telefono.
     *
     * @param int $telefono
     * @return UserInfoAdicionalInterface
     */
    public function setTelefono($telefono);

    /**
     * Get celular.
     *
     * @return int
     */
    public function getCelular();

    /**
     * Set celular.
     *
     * @param int $celular
     * @return UserInfoAdicionalInterface
     */
    public function setCelular($celular);

    /**
     * Get referencia.
     *
     * @return string
     */
    public function getReferencia();

    /**
     * Set referencia.
     *
     * @param string $referencia
     * @return UserInfoAdicionalInterface
     */
    public function setReferencia($referencia);

    /**
     * Get contacto1.
     *
     * @return string
     */
    public function getContacto1();

    /**
     * Set contacto1.
     *
     * @param string $contacto1
     * @return UserInfoAdicionalInterface
     */
    public function setContacto1($contacto1);

    /**
     * Get contacto2.
     *
     * @return string
     */
    public function getContacto2();

    /**
     * Set contacto2.
     *
     * @param string $contacto2
     * @return UserInfoAdicionalInterface
     */
    public function setContacto2($contacto2);
}
