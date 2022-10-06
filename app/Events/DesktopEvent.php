<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DesktopEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private array $message;
    private string $id;
    public function __construct(array  $data, $id=null)
    {
        $this->message = $data['desktopMessage'];
        $this->id = $id ?? '';
   }
    public function broadcastOn(): array
    {
        return ['web'.$this->id];
    }

    public function broadcastWith(){
        return $this->message;
    }

    public function broadcastAs(): string
    {
        return 'taskModify';
    }
}
