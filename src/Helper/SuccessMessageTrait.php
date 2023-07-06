<?php 

declare(strict_types=1);

namespace App\Http\Helper;

trait SuccessMessageTrait
{
    protected function addSuccessMessage(string $message): void
    {
        $_SESSION['success_message'] = $message;
    }
}