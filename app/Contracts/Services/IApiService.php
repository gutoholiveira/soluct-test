<?php

namespace App\Contracts\Services;

interface IApiService
{
    /**
     * Get the API status
     *
     * @return array
     */
    public function getStatus(): array;

    /**
     * Check the database connection
     *
     * @param string $type
     * @return boolean
     */
    public function checkDatabaseConnection(string $type): bool;

    /**
     * Get the system up time running
     *
     * @return string
     */
    public function getSystemUptime(): string;

    /**
     * Get the api memory usage
     *
     * @return string
     */
    public function getMemoryUsage(): string;
}
