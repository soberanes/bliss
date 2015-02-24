<?php

namespace Cshelperzfcuser\Model\Entity;

class User implements UserInterface {

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var int
     */
    protected $gid;
    
    /**
     * @var int
     */
    protected $parent;

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
     * @return UserInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username) {
        $this->username = $username;
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
     * @return UserInterface
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName() {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState() {
        if (null === $this->state) {
            $this->state = 1;
        }
        return $this->state;
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Get gid.
     *
     * @return int
     */
    public function getGid() {
        if (null === $this->gid) {
            $this->gid = 1;
        }
        return $this->gid;
    }

    /**
     * Set state.
     *
     * @param int $gid
     * @return UserInterface
     */
    public function setGid($gid) {
        $this->gid = $gid;
        return $this;
    }

    /**
     * Get parent.
     *
     * @return int
     */
    public function getParent() {
        if (null === $this->parent) {
            $this->parent = 0;
        }
        return $this->parent;
    }

    /**
     * Set state.
     *
     * @param int $parent
     * @return UserInterface
     */
    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }
}
