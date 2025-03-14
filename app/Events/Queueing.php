<?php

namespace App\Events;

use App\Models\Client;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Queueing implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * Create a new event instance.
     */
    public $client;
    public function __construct($client)
    {
        $this->client = $client; 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('queuing-monitoring'),
        ];
    }

    public function broadcastWith()
    {
        $cashierName = User::where('id', $this->client->cashier_Id)->first()->name;
        return [
            'id' => $this->client->id,
            'name' => $this->client->name,
            'cashier_Id' => $this->client->cashier_Id,
            'cashier_name' => $cashierName,  
        ];
    }
    
}
