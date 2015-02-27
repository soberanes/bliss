<?php

namespace Uploader\Model\Entity;

class DataLoaded implements DataLoadedInterface {

	/**
     * @var int
     */
    protected $dataLoadedId;

    /**
     * @var int
     */
    protected $userId;

	/**
     * @var int
     */
    protected $archivoId;

	/**
     * @var int
     */
    protected $month;

	/**
     * @var int
     */
    protected $processDate;

	/**
     * @var int
     */
    protected $status;

    /**
     * Get dataLoadedId.
     *
     * @return int
     */
    public function getDataLoadedId() {
        return $this->dataLoadedId;
    }

    /**
     * Set dataLoadedId.
     *
     * @param int $dataLoadedId
     * @return ModArchivosInterface
     */
    public function setDataLoadedId($dataLoadedId) {
        $this->dataLoadedId = (int) $dataLoadedId;
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
     * Get month.
     *
     * @return int
     */
    public function getMonth() {
        return $this->month;
    }

    /**
     * Set month.
     *
     * @param int $month
     * @return ModArchivosInterface
     */
    public function setMonth($month) {
        $this->month = (int) $month;
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