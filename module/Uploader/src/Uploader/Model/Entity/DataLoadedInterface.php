<?php

namespace Uploader\Model\Entity;

interface DataLoadedInterface {


    /**
     * Get dataLoadedId.
     *
     * @return int
     */
    public function getDataLoadedId();

    /**
     * Set dataLoadedId.
     *
     * @param int $dataLoadedId
     * @return ModArchivosInterface
     */
    public function setDataLoadedId($dataLoadedId);

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
     * Get month.
     *
     * @return int
     */
    public function getMonth();

    /**
     * Set month.
     *
     * @param int $month
     * @return ModArchivosInterface
     */
    public function setMonth($month);

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