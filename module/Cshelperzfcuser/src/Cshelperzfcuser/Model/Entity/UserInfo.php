<?php

namespace Cshelperzfcuser\Model\Entity;

class UserInfo implements UserInfoInterface {

    /**
     * @var int
     */
    protected $profileId;
	
    /**
     * @var int
     */
    protected $userId;
    
	/**
     * @var string
     */
    protected $fullname;
	
	/**
     * @var string
     */
    protected $address;
	
	/**
     * @var string
     */
    protected $phone;
	
	/**
     * @var string
     */
    protected $cellphone;
	
	/**
     * @var string
     */
    protected $email;
	
	/**
     * @var string
     */
    protected $sucursal;
	
	/**
     * @var int
     */
    protected $birthdate;
	
    /**
     * @var int
     */
    protected $lastUpdate;

	/**
     * @var int
     */
    protected $status;
	
    /**
     * @var string
     */
    protected $municipio;

    /**
     * @var int
     */
    protected $estado;

	/**
     * @var string
     */
    protected $zipCode;

    /**
     * Get profileId.
     *
     * @return int
     */
    public function getProfileId() {
        return $this->profileId;
    }

    /**
     * Set profileId.
     *
     * @param int $profileId
     * @return UserInfoInterface
     */
    public function setProfileId($profileId) {
        $this->profileId = (int) $profileId;
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
     * Get fullname.
     *
     * @return string
     */
    public function getFullname() {
        return $this->fullname;
    }

    /**
     * Set fullname.
     *
     * @param string $fullname
     * @return UserInfoInterface
     */
    public function setFullname($fullname) {
        $this->fullname = (string) $fullname;
        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param string $address
     * @return UserInfoInterface
     */
    public function setAddress($address) {
        $this->address = (string) $address;
        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     * @return UserInfoInterface
     */
    public function setPhone($phone) {
        $this->phone = (string) $phone;
        return $this;
    }
	
    /**
     * Get cellphone.
     *
     * @return string
     */
    public function getCellphone() {
        return $this->cellphone;
    }

    /**
     * Set cellphone.
     *
     * @param string $cellphone
     * @return UserInfoInterface
     */
    public function setCellphone($cellphone) {
        $this->cellphone = (string) $cellphone;
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
     * @return UserInfoInterface
     */
    public function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }
	
    /**
     * Get sucursal.
     *
     * @return string
     */
    public function getSucursal() {
        return $this->sucursal;
    }

    /**
     * Set sucursal.
     *
     * @param string $sucursal
     * @return UserInfoInterface
     */
    public function setSucursal($sucursal) {
        $this->sucursal = (string) $sucursal;
        return $this;
    }
	
    /**
     * Get birthdate.
     *
     * @return int
     */
    public function getBirthdate() {
        return $this->birthdate;
    }

    /**
     * Set birthdate.
     *
     * @param string $birthdate
     * @return UserInfoInterface
     */
    public function setBirthdate($birthdate) {
        $this->birthdate = (int) $birthdate;
        return $this;
    }

    /**
     * Get lastUpdate.
     *
     * @return int
     */
    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    /**
     * Set lastUpdate.
     *
     * @param string $lastUpdate
     * @return UserInfoInterface
     */
    public function setLastUpdate($lastUpdate) {
        $this->lastUpdate = (int) $lastUpdate;
        return $this;
    }
	
    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set status.
     *
     * @param string $status
     * @return UserInfoInterface
     */
    public function setStatus($status) {
        $this->status = (int) $status;
        return $this;
    }

    /**
     * Get municipio.
     *
     * @return string
     */
    public function getMunicipio() {
        return $this->municipio;
    }

    /**
     * Set municipio.
     *
     * @param string $municipio
     * @return UserInfoInterface
     */
    public function setMunicipio($municipio) {
        $this->municipio = (string) $municipio;
        return $this;
    }

    /**
     * Get zipCode.
     *
     * @return string
     */
    public function getZipCode() {
        return $this->zipCode;
    }

    /**
     * Set zipCode.
     *
     * @param string $zipCode
     * @return UserInfoInterface
     */
    public function setZipCode($zipCode) {
        $this->zipCode = (string) $zipCode;
        return $this;
    }

    /**
     * Get estado.
     *
     * @return string
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set estado.
     *
     * @param int $estado
     * @return UserInfoInterface
     */
    public function setEstado($estado) {
        $this->estado = (int) $estado;
        return $this;
    }

}