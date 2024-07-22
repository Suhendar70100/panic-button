<?php

namespace App\Jobs;

use App\Models\HistoryButton;
use Illuminate\Contracts\Container\BindingResolutionException;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;
use Illuminate\Support\Facades\Log;
use App\Models\Device;
use App\Models\DeviceActivity;


class SensorJob extends RabbitMQJob
{
    /**
     * @throws BindingResolutionException
     */
    public function fire(): void
    {
        $anyMessage = $this->getRawBody();
        $data = json_decode($anyMessage, true);

         // Validasi data
         if (!isset($data['code_device'], $data['time'])) {
            Log::error('Data tidak lengkap', ['data' => $data]);
            $this->delete(); // Hapus job jika data tidak valid
            return;
        }

        $device = Device::where('code_device', $data['code_device'])->first();
        if (!$device) {
            Log::error('Device tidak ditemukan', ['data' => $data]);
            $this->delete(); // Hapus job jika device tidak ditemukan
            return;
        }

        try {
            DeviceActivity::query()->create([
                'id_device' => $device->id,
                'button_condition' => 'Ditekan',
                'created_at' => $data['time'],
            ]);
            $this->delete(); // Hapus job jika berhasil
        } catch (\Exception $e) {
            Log::error('Error ketika menyimpan data ke tabel Device', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            $this->delete(); // Hapus job jika berhasil
        }
    }


    /**
     * Summary of getName
     */
    public function getName(): string
    {
        return '';
    }
}
