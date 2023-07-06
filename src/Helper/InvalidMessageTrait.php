<?php 

declare(strict_types=1);

namespace App\Http\Helper;

trait InvalidMessageTrait
{
    protected function addErrorMessage(string $errorMessage): void
    {
        $_SESSION['error_message'] = $errorMessage;
    }
}