<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Exceptions extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Error Handler Mode
     * --------------------------------------------------------------------------
     */
    public string $handler = 'CodeIgniter\Debug\Exceptions';

    /**
     * --------------------------------------------------------------------------
     * Custom 404 Override
     * --------------------------------------------------------------------------
     */
    public string $page404 = 'Errors::show404';

    /**
     * --------------------------------------------------------------------------
     * Ignore Log Exceptions
     * --------------------------------------------------------------------------
     */
    public array $ignoreCodes = [
        404,
    ];

    /**
     * --------------------------------------------------------------------------
     * Custom Exception Render
     * --------------------------------------------------------------------------
     */
    public function render(\Throwable $exception): void
    {
        // Development: Show debug page
        if (ENVIRONMENT === 'development') {
            parent::render($exception);
            return;
        }

        // Production: Custom branded pages via Errors controller
        $statusCode = $this->getStatusCode($exception);

        switch ($statusCode) {
            case 500:
                echo view('errors/custom_500');
                break;
            case 503:
                echo view('errors/custom_503');
                break;
            case 404:
                echo view('errors/custom_404');
                break;
            default:
                parent::render($exception);
        }
        
        // Stop execution
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
        exit();
    }

    protected function getStatusCode(\Throwable $exception): int
    {
        // Map exceptions to HTTP codes
        if ($exception instanceof \CodeIgniter\Database\Exceptions\DatabaseException) {
            return 500;
        }
        
        if (method_exists($exception, 'getCode') && $exception->getCode() >= 400 && $exception->getCode() < 600) {
            return $exception->getCode();
        }

        return 500;
    }
}