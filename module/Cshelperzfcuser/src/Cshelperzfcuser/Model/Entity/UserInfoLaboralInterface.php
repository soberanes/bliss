<?php

namespace Cshelperzfcuser\Model\Entity;

interface UserInfoLaboralInterface {

    /**
     * Get userInfoLaboralId.
     *
     * @return int
     */
    public function getUserInfoLaboralId();

    /**
     * Set userInfoLaboralId.
     *
     * @param int $userInfoLaboralId
     * @return UserInfoLaboralInterface
     */
    public function setUserInfoLaboralId($userInfoLaboralId);

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
     * @return UserInfoLaboralInterface
     */
    public function setUserId($userId);

    /**
     * Get empresa.
     *
     * @return string
     */
    public function getEmpresa();

    /**
     * Set empresa.
     *
     * @param string $empresa
     * @return UserInfoLaboralInterface
     */
    public function setEmpresa($empresa);

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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
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
     * @return UserInfoLaboralInterface
     */
    public function setCp($cp);

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
     * @return UserInfoLaboralInterface
     */
    public function setReferencia($referencia);

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
     * @return UserInfoLaboralInterface
     */
    public function setTelefono($telefono);

    /**
     * Get webSite.
     *
     * @return string
     */
    public function getWebSite();

    /**
     * Set webSite.
     *
     * @param string $webSite
     * @return UserInfoLaboralInterface
     */
    public function setWebSite($webSite);

    /**
     * Get cantidadEmpleados.
     *
     * @return int
     */
    public function getCantidadEmpleados();

    /**
     * Set cantidadEmpleados.
     *
     * @param int $cantidadEmpleados
     * @return UserInfoLaboralInterface
     */
    public function setCantidadEmpleados($cantidadEmpleados);

    /**
     * Get m2.
     *
     * @return int
     */
    public function getM2();

    /**
     * Set m2.
     *
     * @param int $m2
     * @return UserInfoLaboralInterface
     */
    public function setM2($m2);

    /**
     * Get actividadId.
     *
     * @return int
     */
    public function getActividadId();

    /**
     * Set actividadId.
     *
     * @param int $actividadId
     * @return UserInfoLaboralInterface
     */
    public function setActividadId($actividadId);
}
