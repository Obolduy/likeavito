<?php
namespace App\Models;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class RabbitmqQueues
{
    public $channel;
    public $queue;
    private $connection;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    public function createInfinityLoop(): void
    {
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function createQueue(string $queue_name): void
    {
        $this->channel->queue_declare($queue_name, false, false, false, false);
        $this->queue = $queue_name;
    }

    public function sendMessage(string $message): void
    {
        $queue_member = new AMQPMessage($message);
        $this->channel->basic_publish($queue_member, '', $this->queue);
    }

    public function createConsume($callback): void
    {
        $this->channel->basic_consume($this->queue, '', false, true, false, false, $callback);
    }

    abstract public function createCallback();
}