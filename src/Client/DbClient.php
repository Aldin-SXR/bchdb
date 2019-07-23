<?php

namespace BCHDB\Client;

use MongoDB\Collection;

class DbClient {
    /** @var \MongoDB\Client MongoDB client. */
    private $client;
    /** @var EnvClient $env Access to environment variables. */
    private $env;
    /** @var Collection $collection MongoDB collection being used. */
    private $collection;

    /**
     * Create a database client object.
     * @return DbClient
     */
    public function __construct() {
        $this->env = new EnvClient();
        $uri = $this->env->get('DB_URL')."?retryWrites=true";
        $this->client = new \MongoDB\Client($uri);
    }

    /**
     * Select a collection.
     * Provide a collection to be used by the following operation.
     * @param string $name Collection name.
     * @return DbClient The database client object.
     */
    public function collection($name) {
        $this->collection = $this->client->selectCollection($this->env->get('DB_NAME'), $name);
        return $this;
    }

    /**
     * Create indices.
     * Creates MongoDB collection indices given an array with key names and types (ascending or descending).
     * @param array $indices Array of indices to be created.
     * @return void
     */
    public function index($indices) {
        $idx_data = [ ];
        foreach ($indices as $index) {
            $idx_data[ ] = $this->collection->createIndex($index);
        }
        return $idx_data;
    }

    /**
     * Insert/update data.
     * Adds a record to the collection if it does not exist; otherwise, it updates it.
     * @param string $_id Record ID.
     * @param array $data Data to be inserted/updated.
     */
    public function upsert($_id, $data) {
        return $this->collection->updateOne([ '_id' => $_id ], [ '$set' => $data ], [ 'upsert' => true ]);
    }

    /**
     * Drop a collection.
     * Delete a collection and all its records.
     * @return void
     */
    public function drop() {
        $this->collection->drop();
    }
}