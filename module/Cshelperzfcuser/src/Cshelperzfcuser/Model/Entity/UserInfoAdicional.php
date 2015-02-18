<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfoAdicional implements UserInfoAdicionalInterface {

    /**
     * @var int
     */
    protected $userInfoAdicionalId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $direccion;

    /**
     * @var string
     */
    protected $ciudad;

    /**
     * @var int
     */
    protected $estadoId;

    /**
     * @var int
     */
    protected $cp;

    /**
     * @var int
     */
    protected $telefono;

    /**
     * @var int
     */
    protected $celular;

    /**
     * @var string
     */
    protected $referencia;

    /**
     * @var string
     */
    protected $contacto1;

    /**
     * @var string
     */
    protected $contacto2;

    /**
     * Get userInfoAdicionalId.
     *
     * @return int
     */
    public function getUserInfoAdicionalId() {
        return $this->userInfoAdicionalId;
    }

    /**
     * Set userInfoAdicionalId.
     *
     * @param int $userInfoAdicionalId
     * @return UserInfoAdicionalInterface
     */
    public function setUserInfoAdicionalId($userInfoAdicionalId) {
        $this->userInfoAdicionalId = (int) $userInfoAdicionalId;
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
     * @return UserInfoAdicionalInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get direccion.
     *
     * @return string
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set direccion.
     *
     * @param string $direccion
     * @return UserInfoAdicionalInterface
     */
    public function setDireccion($direccion) {
        $this->direccion = (string) $direccion;
        return $this;
    }

    /**
     * Get ciudad.
     *
     * @return string
     */
    public function getCiudad() {
        return $this->ciudad;
    }

    /**
     * Set ciudad.
     *
     * @param string $ciudad
     * @return UserInfoAdicionalInterface
     */
    public function setCiudad($ciudad) {
        $this->ciudad = (string) $ciudad;
        return $this;
    }

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
     * @return UserInfoAdicionalInterface
     */
    public function setEstadoId($estadoId) {
        $this->estadoId = (int) $estadoId;
        return $this;
    }

    /**
     * Get cp.
     *
     * @return int
     */
    public function getCp() {
        return $this->cp;
    }

    /**
     * Set cp.
     *
     * @param int $cp
     * @return UserInfoAdicionalInterface
     */
    public function setCp($cp) {
        $this->cp = (int) $cp;
        return $this;
    }

    /**
     * Get telefono.
     *
     * @return int
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set telefono.
     *
     * @param int $telefono
     * @return UserInfoAdicionalInterface
     */
    public function setTelefono($telefono) {
        $this->telefono = (int) $telefono;
        return $this;
    }

    /**
     * Get celular.
     *
     * @return int
     */
    public function getCelular() {
        return $this->celular;
    }

    /**
     * Set celular.
     *
     * @param int $celular
     * @return UserInfoAdicionalInterface
     */
    public function setCelular($celular) {
        $this->celular = (int) $celular;
        return $this;
    }

    /**
     * Get referencia.
     *
     * @return string
     */
    public function getReferencia() {
        return $this->referencia;
    }

    /**
     * Set referencia.
     *
     * @param string $referencia
     * @return UserInfoAdicionalInterface
     */
    public function setReferencia($referencia) {
        $this->referencia = (string) $referencia;
        return $this;
    }

    /**
     * Get contacto1.
     *
     * @return string
     */
    public function getContacto1() {
        return $this->contacto1;
    }

    /**
     * Set contacto1.
     *
     * @param string $contacto1
     * @return UserInfoAdicionalInterface
     */
    public function setContacto1($contacto1) {
        $this->contacto1 = (string) $contacto1;
        return $this;
    }

    /**
     * Get contacto2.
     *
     * @return string
     */
    public function getContacto2() {
        return $this->contacto2;
    }

    /**
     * Set contacto2.
     *
     * @param string $contacto2
     * @return UserInfoAdicionalInterface
     */
    public function setContacto2($contacto2) {
        $this->contacto2 = (string) $contacto2;
        return $this;
    }

}
