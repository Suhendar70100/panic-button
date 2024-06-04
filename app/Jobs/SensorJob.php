<?php

namespace App\Jobs;

use App\Models\HistoryButton;
use Illuminate\Contracts\Container\BindingResolutionException;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;
use Illuminate\Support\Facades\Log;


class SensorJob extends RabbitMQJob
{
    /**
     * @throws BindingResolutionException
     */
    public function fire(): void
    {
        $anyMessage = $this->getRawBody();
        $data = json_decode($anyMessage, true);

        Log::info("Data yang ingin Anda log: " . $anyMessage);

        $this->delete();
    }

    /**
     * Summary of getName
     */
    public function getName(): string
    {
        return '';
    }
}
