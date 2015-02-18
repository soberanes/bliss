<?php

namespace Cshelperzfcuser\Model\Entity;

interface UserInfoInterface {

    /**
     * Get userInfoId.
     *
     * @return int
     */
    public function getUserInfoAdicionalId();

    /**
     * Set userInfoId.
     *
     * @param int $userInfoId
     * @return UserInfoInterface
     */
    public function setUserInfoAdicionalId($userInfoId);

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
     * @return UserInfoInterface
     */
    public function setUserId($userId);

    /**
     * Get razon_social
     *
     * @return int
     */
    public function getRazonSocial();

    /**
     * Set razon_social
     *
     * @param int $razon_social
     * @return UserInfoInterface
     */
    public function setRazonSocial($razon_social);

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre();

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return UserInfoInterface
     */
    public function setNombre($nombre);

    /**
     * Get nombre_distribuidor
     *
     * @return string
     */
    public function getNombreDistribuidor();

    /**
     * Set nombre_distribuidor
     *
     * @param string $nombre_distribuidor
     * @return UserInfoInterface
     */
    public function setNombreDistribuidor($nombre_distribuidor);

    /**
     * Get nombre_vendedor
     *
     * @return string
     */
    public function getNombreVendedor();

    /**
     * Set nombre_vendedor
     *
     * @param string $nombre_vendedor
     * @return UserInfoInterface
     */
    public function setNombreVendedor($nombre_vendedor);

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio();

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return UserInfoInterface
     */
    public function setDomicilio($domicilio);

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstadoId();

    /**
     * Set estado
     *
     * @param string $estado
     * @return UserInfoInterface
     */
    public function setEstadoId($estado_id);

    /**
     * Get cp
     *
     * @return string
     */
    public function getCpId();

    /**
     * Set cp
     *
     * @param string $cp
     * @return UserInfoInterface
     */
    public function setCpId($cp_id);

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono();

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return UserInfoInterface
     */
    public function setTelefono($telefono);

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular();

    /**
     * Set celular
     *
     * @param string $celular
     * @return UserInfoInterface
     */
    public function setCelular($celular);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     * @return UserInfoInterface
     */
    public function setEmail($email);

    /**
     * Get last_update
     *
     * @return int
     */
    public function getLastUpdate();

    /**
     * Set int
     *
     * @param int $last_update
     * @return UserInfoInterface
     */
    public function setLastUpdate($last_update);

    /**
     * Get creation_date
     *
     * @return int
     */
    public function getCreationDate();

    /**
     * Set int
     *
     * @param int $creation_date
     * @return UserInfoInterface
     */
    public function setCreationDate($creation_date);

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set last_update
     *
     * @param int $last_update
     * @return UserInfoInterface
     */
    public function setStatus($status);

}
