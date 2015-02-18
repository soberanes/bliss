<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfoCandidato implements UserInfoCandidatoInterface {

    /**
     * @var int
     */
    protected $userInfoCandidatoId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $telefono;

    /**
     * Get userInfoCandidatoId.
     *
     * @return int
     */
    public function getUserInfoCandidatoId() {
        return $this->userInfoCandidatoId;
    }

    /**
     * Set userInfoCandidatoId.
     *
     * @param int $userInfoCandidatoId
     * @return UserInfoCandidatoInterface
     */
    public function setUserInfoCandidatoId($userInfoCandidatoId) {
        $this->userInfoCandidatoId = (int) $userInfoCandidatoId;
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
     * @return UserInfoCandidatoInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
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
     * @return UserInfoCandidatoInterface
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

    /**
     * Get email.
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
     * @return UserInfoCandidatoInterface
     */
    public function setEmail($email) {
        $this->email = (string) $email;
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
     * @return UserInfoCandidatoInterface
     */
    public function setTelefono($telefono) {
        $this->telefono = (int) $telefono;
        return $this;
    }

}
