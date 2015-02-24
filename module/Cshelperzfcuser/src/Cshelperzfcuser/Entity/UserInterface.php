<?php

namespace Cshelperzfcuser\Entity;

interface UserInterface {
	/**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id);

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username);

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
     * @return UserInterface
     */
    public function setEmail($email);

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName);

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword();

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * Get state.
     *
     * @return int
     */
    public function getState();

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state);

    /**
     * Get gid.
     *
     * @return int
     */
    public function getGid();

    /**
     * Set state.
     *
     * @param int $gid
     * @return UserInterface
     */
    public function setGid($gid);

    /**
     * Get parent.
     *
     * @return int
     */
    public function getParent();

    /**
     * Set state.
     *
     * @param int $parent
     * @return UserInterface
     */
    public function setParent($parent);
}
