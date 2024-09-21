<?php

namespace App\Events;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Broadcasting\Channel;
use App\Notifications\NotifikasiDosen;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReviewPenyelia
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
            'Pengisian Review Penyelia dari ' . $mahasiswa->nama,
            route('pageReviewPenyelia')
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
