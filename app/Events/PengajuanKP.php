<?php

namespace App\Events;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Notifications\NotifikasiDosen;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PengajuanKP
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $dosen;

    /**
     * Create a new event instance.
     */
    public function __construct(Mahasiswa $mahasiswa, Dosen $dosen)
    {
        $this->dosen = $dosen;
        $dosen->user->notify(new NotifikasiDosen(
            'Pengajuan Kerja Praktek dari ' . $mahasiswa->nama,
            route('pageDaftarMhsBimbingan')
        ));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.' . $this->dosen->user->id),
        ];
    }
}
