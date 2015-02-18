<?php

namespace Cshelperzfcuser\Model\Entity;

interface UserInfoCandidatoInterface {

    /**
     * Get userInfoCandidatoId.
     *
     * @return int
     */
    public function getUserInfoCandidatoId();

    /**
     * Set userInfoCandidatoId.
     *
     * @param int $userInfoCandidatoId
     * @return UserInfoCandidatoInterface
     */
    public function setUserInfoCandidatoId($userInfoCandidatoId);

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
     * @return UserInfoCandidatoInterface
     */
    public function setUserId($userId);

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre();

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return UserInfoCandidatoInterface
     */
    public function setNombre($nombre);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInfoCandidatoInterface
     */
    public function setEmail($email);

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
     * @return UserInfoCandidatoInterface
     */
    public function setTelefono($telefono);
}
