<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfo implements UserInfoInterface {

    /**
     * @var int
     */
    protected $userInfoId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $tituloId;

    /**
     * @var string
     */
    protected $apPaterno;

    /**
     * @var string
     */
    protected $apMaterno;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $noSiebel;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $dia;

    /**
     * @var int
     */
    protected $mes;

    /**
     * @var int
     */
    protected $anio;

    /**
     * @var int
     */
    protected $fechaNacimiento;

    /**
     * @var string
     */
    protected $puesto;

    /**
     * @var int
     */
    protected $experiencia;

    /**
     * @var string
     */
    protected $administrador;

    /**
     * @var int
     */
    protected $fechaCreacion;

    /**
     * Get userInfoId.
     *
     * @return int
     */
    public function getUserInfoId() {
        return $this->userInfoId;
    }

    /**
     * Set userInfoId.
     *
     * @param int $userInfoId
     * @return UserInfoInterface
     */
    public function setUserInfoId($userInfoId) {
        $this->userInfoId = (int) $userInfoId;
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
     * @return UserInfoInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get tituloId.
     *
     * @return int
     */
    public function getTituloId() {
        return $this->tituloId;
    }

    /**
     * Set tituloId.
     *
     * @param int $tituloId
     * @return UserInfoInterface
     */
    public function setTituloId($tituloId) {
        $this->tituloId = (int) $tituloId;
        return $this;
    }

    /**
     * Get apPaterno.
     *
     * @return string
     */
    public function getApPaterno() {
        return $this->apPaterno;
    }

    /**
     * Set apPaterno.
     *
     * @param string $apPaterno
     * @return UserInfoInterface
     */
    public function setApPaterno($apPaterno) {
        $this->apPaterno = (string) $apPaterno;
        return $this;
    }

    /**
     * Get apMaterno.
     *
     * @return string
     */
    public function getApMaterno() {
        return $this->apMaterno;
    }

    /**
     * Set apMaterno.
     *
     * @param string $apMaterno
     * @return UserInfoInterface
     */
    public function setApMaterno($apMaterno) {
        $this->apMaterno = (string) $apMaterno;
        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return UserInfoInterface
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNoSiebel() {
        return $this->noSiebel;
    }

    /**
     * Set noSiebel.
     *
     * @param string $noSiebel
     * @return UserInfoInterface
     */
    public function setNoSiebel($noSiebel) {
        $this->noSiebel = (string) $noSiebel;
        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInfoInterface
     */
    public function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * Get fechaNacimiento.
     *
     * @return int
     */
    public function getFechaNacimiento() {
        return $this->getDia() + $this->getMes() + $this->getAnio();
    }

    /**
     * Set fechaNacimiento.
     *
     * @param int $fechaNacimiento
     * @return UserInfoInterface
     */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = (int) $fechaNacimiento;
        return $this;
    }

    /**
     * Get puesto.
     *
     * @return string
     */
    public function getPuesto() {
        return $this->puesto;
    }

    /**
     * Set puesto.
     *
     * @param string $puesto
     * @return UserInfoInterface
     */
    public function setPuesto($puesto) {
        $this->puesto = (string) $puesto;
        return $this;
    }

    /**
     * Get experiencia.
     *
     * @return int
     */
    public function getExperiencia() {
        return $this->experiencia;
    }

    /**
     * Set experiencia.
     *
     * @param int $experiencia
     * @return UserInfoInterface
     */
    public function setExperiencia($experiencia) {
        $this->experiencia = (int) $experiencia;
        return $this;
    }

    /**
     * Get administrador.
     *
     * @return string
     */
    public function getAdministrador() {
        return $this->administrador;
    }

    /**
     * Set administrador.
     *
     * @param string $administrador
     * @return UserInfoInterface
     */
    public function setAdministrador($administrador) {
        $this->administrador = (string) $administrador;
        return $this;
    }

    /**
     * Set anio.
     *
     * @param int $anio
     * @return UserInfoInterface
     */
    private function getAnio() {
        return $this->anio;
    }

    /**
     * Get dia.
     *
     * @return int
     */
    private function getDia() {
        return $this->dia;
    }

    /**
     * Get mes.
     *
     * @return int
     */
    private function getMes() {
        return $this->mes;
    }

    /**
     * Get anio.
     *
     * @return int
     */
    public function setAnio($anio) {
        $this->anio = (int) $anio;
        return $this;
    }

    /**
     * Set dia.
     *
     * @param int $dia
     * @return UserInfoInterface
     */
    public function setDia($dia) {
        $this->dia = (int) $dia;
        return $this;
    }

    /**
     * Set mes.
     *
     * @param int $mes
     * @return UserInfoInterface
     */
    public function setMes($mes) {
        $this->mes = (int) $mes;
        return $this;
    }

    /**
     * Set fechaCreacion.
     *
     * @param int $fechaCreacion
     * @return UserInfoInterface
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = (int) $fechaCreacion;
        return $this;
    }

    /**
     * get fechaCreacion.
     *
     * @return int
     */
    public function getFechaCreacion() {
        return null === $this->fechaCreacion ? time() : $this->fechaCreacion;
    }

}
