<?php

namespace Uploader\Model\Entity;

interface ModArchivosInterface {

    /**
     * Get archivoId.
     *
     * @return int
     */
    public function getArchivoId();

    /**
     * Set archivoId.
     *
     * @param int $archivoId
     * @return ModArchivosInterface
     */
    public function setArchivoId($archivoId);

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
     * @return ModArchivosInterface
     */
    public function setUserId($userId);

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename();

    /**
     * Set filename.
     *
     * @param string $filename
     * @return ModArchivosInterface
     */
    public function setFilename($filename);

    /**
     * Get creationDate.
     *
     * @return int
     */
    public function getCreationDate();

    /**
     * Set creationDate.
     *
     * @param int $creationDate
     * @return ModArchivosInterface
     */
    public function setCreationDate($creationDate);

    /**
     * Get processDate.
     *
     * @return int
     */
    public function getProcessDate();

    /**
     * Set processDate.
     *
     * @param int $processDate
     * @return ModArchivosInterface
     */
    public function setProcessDate($processDate);

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param int $status
     * @return ModArchivosInterface
     */
    public function setStatus($status);

}
