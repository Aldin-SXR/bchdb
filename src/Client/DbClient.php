<?php

namespace BCHDB\Client;

class DbClient {
    /** @var \MongoDB\Client MongoDB client. */
    private $client;
    /** @var EnvClient $env Access to environment variables. */
    private $env;

    private $collection;

    public function __construct() {
        $this->env = new EnvClient();
        $uri = $this->env->get('DB_URL')."?retryWrites=true";
        $this->client = new \MongoDB\Client($uri);
    }

    public function collection($name) {
        $this->collection = $this->client->selectCollection($this->env->get('DB_NAME'), $name);
        return $this;
    }

    public function insert($data) {
        $this->collection->insertOne($data);
    }

    public function upsert($_id, $data) {
        $this->collection->updateOne([ '_id' => $_id ], [ '$set' => $data ], [ 'upsert' => true ]);
    }
}