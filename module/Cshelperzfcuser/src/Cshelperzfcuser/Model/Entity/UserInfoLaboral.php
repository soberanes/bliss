<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfoLaboral implements UserInfoLaboralInterface {

    /**
     * @var int
     */
    protected $userInfoLaboralId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $empresa;

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
     * @var string
     */
    protected $referencia;

    /**
     * @var int
     */
    protected $telefono;

    /**
     * @var string
     */
    protected $webSite;

    /**
     * @var int
     */
    protected $cantidadEmpleados;

    /**
     * @var int
     */
    protected $m2;

    /**
     * @var int
     */
    protected $actividadId;

    /**
     * Get userInfoLaboralId.
     *
     * @return int
     */
    public function getUserInfoLaboralId() {
        return $this->userInfoLaboralId;
    }

    /**
     * Set userInfoLaboralId.
     *
     * @param int $userInfoLaboralId
     * @return UserInfoLaboralInterface
     */
    public function setUserInfoLaboralId($userInfoLaboralId) {
        $this->userInfoLaboralId = (int) $userInfoLaboralId;
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
     * @return UserInfoLaboralInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get empresa.
     *
     * @return string
     */
    public function getEmpresa() {
        return $this->empresa;
    }

    /**
     * Set empresa.
     *
     * @param string $empresa
     * @return UserInfoLaboralInterface
     */
    public function setEmpresa($empresa) {
        $this->empresa = (string) $empresa;
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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
     */
    public function setCp($cp) {
        $this->cp = (int) $cp;
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
     * @return UserInfoLaboralInterface
     */
    public function setReferencia($referencia) {
        $this->referencia = (string) $referencia;
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
     * @return UserInfoLaboralInterface
     */
    public function setTelefono($telefono) {
        $this->telefono = (int) $telefono;
        return $this;
    }

    /**
     * Get webSite.
     *
     * @return string
     */
    public function getWebSite() {
        return $this->webSite;
    }

    /**
     * Set webSite.
     *
     * @param string $webSite
     * @return UserInfoLaboralInterface
     */
    public function setWebSite($webSite) {
        $this->webSite = (string) $webSite;
        return $this;
    }


    /**
     * Get cantidadEmpleados.
     *
     * @return int
     */
    public function getCantidadEmpleados() {
        return $this->cantidadEmpleados;
    }

    /**
     * Set cantidadEmpleados.
     *
     * @param int $cantidadEmpleados
     * @return UserInfoLaboralInterface
     */
    public function setCantidadEmpleados($cantidadEmpleados) {
        $this->cantidadEmpleados = (int) $cantidadEmpleados;
        return $this;
    }

    /**
     * Get m2.
     *
     * @return int
     */
    public function getM2() {
        return $this->m2;
    }

    /**
     * Set m2.
     *
     * @param int $m2
     * @return UserInfoLaboralInterface
     */
    public function setM2($m2) {
        $this->m2 = (int) $m2;
        return $this;
    }

    /**
     * Get actividadId.
     *
     * @return int
     */
    public function getActividadId() {
        return $this->actividadId;
    }

    /**
     * Set actividadId.
     *
     * @param int $actividadId
     * @return UserInfoLaboralInterface
     */
    public function setActividadId($actividadId) {
        $this->actividadId = (int) $actividadId;
        return $this;
    }

}
