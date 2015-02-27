<?php

namespace Uploader\Model\Entity;

class ModArchivos implements ModArchivosInterface {

    /**
     * @var int
     */
    protected $archivoId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $periodM;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var int
     */
    protected $uploadDate;

    /**
     * @var int
     */
    protected $processDate;

    /**
     * @var int
     */
    protected $status;

    /**
     * Get archivoId.
     *
     * @return int
     */
    public function getArchivoId() {
        return $this->archivoId;
    }

    /**
     * Set archivoId.
     *
     * @param int $archivoId
     * @return ModArchivosInterface
     */
    public function setArchivoId($archivoId) {
        $this->archivoId = (int) $archivoId;
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
     * @return ModArchivosInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get periodM.
     *
     * @return int
     */
    public function getPeriodM() {
        return $this->periodM;
    }

    /**
     * Set periodM.
     *
     * @param int $periodM
     * @return ModArchivosInterface
     */
    public function setPeriodM($periodM) {
        $this->periodM = (int) $periodM;
        return $this;
    }

    /**
     * Get filename.
     *
     * @return string
     */
    public function getFilename() {
        return $this->filename;
    }

    /**
     * Set filename.
     *
     * @param string $filename
     * @return ModArchivosInterface
     */
    public function setFilename($filename) {
        $this->filename = (string) $filename;
        return $this;
    }

    /**
     * Get uploadDate.
     *
     * @return int
     */
    public function getUploadDate() {
        return $this->uploadDate;
    }

    /**
     * Set uploadDate.
     *
     * @param int $uploadDate
     * @return ModArchivosInterface
     */
    public function setUploadDate($uploadDate) {
        $this->uploadDate = (int) $uploadDate;
        return $this;
    }

    /**
     * Get processDate.
     * 
     * @return int
     */
    public function getProcessDate() {
        return $this->processDate;
    }

    /**
     * Set processDate.
     *
     * @param int $processDate
     * @return ModArchivosInterface
     */
    public function setProcessDate($processDate) {
        $this->processDate = (int) $processDate;
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
     * @param int $status
     * @return ModArchivosInterface
     */
    public function setStatus($status) {
        $this->status = (int) $status;
        return $this;
    }

}
