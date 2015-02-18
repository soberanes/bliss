<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfo implements UserInfoInterface {

    /**
     * @var int
     */
    protected $user_info_adicional_id;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var String
     */
    protected $razon_social;

    /**
     * @var String
     */
    protected $nombre;

    /**
     * @var String
     */
    protected $nombre_distribuidor;

	/**
     * @var String
     */
    protected $nombre_vendedor;

	/**
     * @var String
     */
    protected $domicilio;

	/**
     * @var String
     */
    protected $estado_id;

	/**
     * @var String
     */
    protected $cp_id;

	/**
     * @var String
     */
    protected $telefono;

	/**
     * @var String
     */
    protected $celular;

	/**
     * @var String
     */
    protected $email;

    /**
     * @var int
     */
    protected $last_update;

    /**
     * @var int
     */
    protected $creation_date;

    /**
     * @var int
     */
    protected $status;


    /**
     * Get user_ionfo_adicional_id.
     *
     * @return int
     */
    public function getUserInfoAdicionalId() {
        return $this->user_info_adicional_id;
    }

    /**
     * Set user_ionfo_adicional_id.
     *
     * @param int $user_ionfo_adicional_id
     * @return UserInfoInterface
     */
    public function setUserInfoAdicionalId($user_info_adicional_id) {
        $this->user_info_adicional_id = (int) $user_info_adicional_id;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Set user_id
     *
     * @param int $user_id
     * @return UserInfoInterface
     */
    public function setUserId($user_id) {
        $this->user_id = (int) $user_id;
        return $this;
    }

    /**
     * Get razon_social
     *
     * @return string
     */
    public function getRazonSocial() {
        return $this->razon_social;
    }

    /**
     * Set razon_social
     *
     * @param string $razon_social
     * @return UserInfoInterface
     */
    public function setRazonSocial($razon_social) {
        $this->razon_social = (string) $razon_social;
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return UserInfoInterface
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

    /**
     * Get nombre_distribuidor
     *
     * @return string
     */
    public function getNombreDistribuidor() {
        return $this->nombre_distribuidor;
    }

    /**
     * Set nombre_distribuidor
     *
     * @param string $nombre_distribuidor
     * @return UserInfoInterface
     */
    public function setNombreDistribuidor($nombre_distribuidor) {
        $this->nombre_distribuidor = (string) $nombre_distribuidor;
        return $this;
    }

    /**
     * Get nombre_vendedor
     *
     * @return string
     */
    public function getNombreVendedor() {
        return $this->nombre_vendedor;
    }

    /**
     * Set nombre_vendedor
     *
     * @param string $nombre_vendedor
     * @return UserInfoInterface
     */
    public function setNombreVendedor($nombre_vendedor) {
        $this->nombre_vendedor = (string) $nombre_vendedor;
        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio() {
        return $this->domicilio;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return UserInfoInterface
     */
    public function setDomicilio($domicilio) {
        $this->domicilio = (string) $domicilio;
        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstadoId() {
        return $this->estado_id;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return UserInfoInterface
     */
    public function setEstadoId($estado_id) {
        $this->estado_id = (string) $estado_id;
        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCpId() {
        return $this->cp_id;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return UserInfoInterface
     */
    public function setCpId($cp_id) {
        $this->cp_id = (string) $cp_id;
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return UserInfoInterface
     */
    public function setTelefono($telefono) {
        $this->telefono = (string) $telefono;
        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular() {
        return $this->celular;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return UserInfoInterface
     */
    public function setCelular($celular) {
        $this->celular = (string) $celular;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return UserInfoInterface
     */
    public function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * Get last_update
     *
     * @return string
     */
    public function getLastUpdate() {
        return $this->last_update;
    }

    /**
     * Set last_update
     *
     * @param string $last_update
     * @return UserInfoInterface
     */
    public function setLastUpdate($last_update) {
        $this->last_update = (string) $last_update;
        return $this;
    }

    /**
     * Get creation_date
     *
     * @return string
     */
    public function getCreationDate() {
        return $this->creation_date;
    }

    /**
     * Set creation_date
     *
     * @param string $creation_date
     * @return UserInfoInterface
     */
    public function setCreationDate($creation_date) {
        $this->creation_date = (string) $creation_date;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return UserInfoInterface
     */
    public function setStatus($status) {
        $this->status = (string) $status;
        return $this;
    }


}