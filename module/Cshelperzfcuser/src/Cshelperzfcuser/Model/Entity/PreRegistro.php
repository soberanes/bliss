<?php

namespace Cshelperzfcuser\Model\Entity;

class PreRegistro implements PreRegistroInterface {

    /**
     * @var int
     */
    protected $preRegistroId;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $estatus;

    /**
     * Get preRegistroId.
     *
     * @return int
     */
    public function getPreRegistroId() {
        return $this->preRegistroId;
    }

    /**
     * Set preRegistroId.
     *
     * @param int $preRegistroId
     * @return PreRegistroInterface
     */
    public function setPreRegistroId($preRegistroId) {
        $this->preRegistroId = (int) $preRegistroId;
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
     * @return PreRegistroInterface
     */
    public function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus() {
        return $this->estatus;
    }

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return PreRegistroInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
