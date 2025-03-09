<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService
{
    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logError(string $message, array $context = []): void
    {
        Log::error($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logInfo(string $message, array $context = []): void
    {
        Log::info($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logWarning(string $message, array $context = []) :void
    {
        Log::warning($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function logDebug(string $message, array $context = []): void
    {
        Log::debug($message, $context);
    }
}
