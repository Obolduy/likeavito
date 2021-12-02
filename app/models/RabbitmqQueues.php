<?php
namespace App\Models;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class RabbitmqQueues
{
    public $queue;
    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            $_ENV['RABBIT_MQ_HOST'], $_ENV['RABBIT_MQ_PORT'],
            $_ENV['RABBIT_MQ_LOGIN'], $_ENV['RABBIT_MQ_PASSWORD']
        );
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