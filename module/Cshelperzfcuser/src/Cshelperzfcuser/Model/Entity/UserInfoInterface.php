<?php

namespace Cshelperzfcuser\Model\Entity;

interface UserInfoInterface {

    /**
     * Get profileId.
     *
     * @return int
     */
    public function getProfileId();

    /**
     * Set profileId.
     *
     * @param int $profileId
     * @return UserInfoInterface
     */
    public function setProfileId($profileId);
	
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
     * Get fullname.
     *
     * @return string
     */
    public function getFullname();

    /**
     * Set fullname.
     *
     * @param string $fullname
     * @return UserInfoInterface
     */
    public function setFullname($fullname);
	
    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress();

    /**
     * Set fullname.
     *
     * @param string $fullname
     * @return UserInfoInterface
     */
    public function setAddress($address);
	
    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone();

    /**
     * Set phone.
     *
     * @param string $phone
     * @return UserInfoInterface
     */
    public function setPhone($phone);
	
    /**
     * Get cellphone.
     *
     * @return string
     */
    public function getCellphone();

    /**
     * Set cellphone.
     *
     * @param string $cellphone
     * @return UserInfoInterface
     */
    public function setCellphone($cellphone);
	
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
     * @return UserInfoInterface
     */
    public function setEmail($email);
	
    /**
     * Get sucursal.
     *
     * @return string
     */
    public function getSucursal();

    /**
     * Set sucursal.
     *
     * @param string $sucursal
     * @return UserInfoInterface
     */
    public function setSucursal($sucursal);
	
    /**
     * Get birthdate.
     *
     * @return int
     */
    public function getBirthdate();

    /**
     * Set birthdate.
     *
     * @param string $birthdate
     * @return UserInfoInterface
     */
    public function setBirthdate($birthdate);
	
	/**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param string $status
     * @return UserInfoInterface
     */
    public function setStatus($status);

    /**
     * Get comercial.
     *
     * @return string
     */
    public function getComercial();

    /**
     * Set comercial.
     *
     * @param string $comercial
     * @return UserInfoInterface
     */
    public function setComercial($comercial);

    /**
     * Get rfc.
     *
     * @return string
     */
    public function getRfc();

    /**
     * Set rfc.
     *
     * @param string $rfc
     * @return UserInfoInterface
     */
    public function setRfc($rfc);
	
}
