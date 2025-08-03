<?php

namespace App\Events;

use App\Models\PesanChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(PesanChat $message)
    {
        $this->message = $message;
    }

    // Data yang akan dikirim ke Pusher
    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'pesan' => $this->message->pesan,
            'pengirim_id' => $this->message->pengirim_id,
            'tipe_pengirim' => $this->message->tipe_pengirim,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }

    // Nama channel (private agar hanya user & konselor terkait yang bisa join)
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->pesan_konsultasi_konselor_id),
        ];
    }
}
