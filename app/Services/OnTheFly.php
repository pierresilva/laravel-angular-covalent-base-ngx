<?php

namespace App\Services;

use App\Client;
use Illuminate\Support\Facades\Config;

class OnTheFly
{
    /**
     * @var Client
     */
    private $client;

    /**
     * SlaveConnection constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     */
    public function setConnection(int $id = null)
    {

        if (!$id) {
            return;
        }

        $this->client = $this->client->findOrFail($id);

        Config::set('database.connections.' . $this->client->database_name, [
            'driver'   => 'mysql',
            'host'     => $this->client->database_host,
            'port'     => $this->client->database_port,
            'database' => $this->client->database_database,
            'username' => $this->client->database_username,
            'password' => $this->client->database_password,
        ]);
    }

    /**
     * @return string
     */
    public function getConnectionName()
    {
        return $this->client->database_name;
    }
}
