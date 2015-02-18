<?php

namespace Cshelperzfcuser\Model\Entity;

interface PreRegistroInterface {

    /**
     * Get preRegistroId.
     *
     * @return int
     */
    public function getPreRegistroId();

    /**
     * Set preRegistroId.
     *
     * @param int $preRegistroId
     * @return PreRegistroInterface
     */
    public function setPreRegistroId($preRegistroId);

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
     * @return PreRegistroInterface
     */
    public function setEmail($email);

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus();

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return PreRegistroInterface
     */
    public function setEstatus($estatus);
}
