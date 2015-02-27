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
     * Get periodM.
     *
     * @return int
     */
    public function getPeriodM();

    /**
     * Set periodM.
     *
     * @param int $periodM
     * @return ModArchivosInterface
     */
    public function setPeriodM($periodM);

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
     * Get uploadDate.
     *
     * @return int
     */
    public function getUploadDate();

    /**
     * Set uploadDate.
     *
     * @param int $uploadDate
     * @return ModArchivosInterface
     */
    public function setUploadDate($uploadDate);

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
