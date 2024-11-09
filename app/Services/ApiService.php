<?php

namespace App\Services;

use App\Contracts\Services\IApiService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ApiService implements IApiService
{
    public function getStatus(): array
    {
        $databaseStatus = [
            'read'  => $this->checkDatabaseConnection('read'),
            'write' => $this->checkDatabaseConnection('write'),
        ];

        $lastCronExecution = Cache::get('last_cron_execution', 'Não executado recentemente');

        $uptime      = $this->getSystemUptime();
        $memoryUsage = $this->getMemoryUsage();

        return [
            'api_details' => [
                'database_connection' => $databaseStatus,
                'last_cron_execution' => $lastCronExecution,
                'uptime'              => $uptime,
                'memory_usage'        => $memoryUsage,
            ]
        ];
    }

    public function checkDatabaseConnection(string $type): bool
    {
        try {
            if ($type === 'read') {
                DB::connection()->select('SELECT 1');
            } else {
                DB::connection()->getPdo()->exec('DO 1');
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSystemUptime(): string
    {
        if (PHP_OS_FAMILY === 'Linux') {
            $uptime = shell_exec("awk '{print $1}' /proc/uptime");
            return gmdate("H:i:s", (int)$uptime) . ' horas';
        }
        return 'Não disponível';
    }

    public function getMemoryUsage(): string
    {
        $memoryUsage = memory_get_usage(true);
        return round($memoryUsage / 1024 / 1024, 2) . ' MB';
    }
}
