<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Collection;

abstract class MongoModel
{
    protected $collection;

    public function __construct()
    {
        $client = app(Client::class);
        $this->collection = $client->selectCollection(env('MONGO_DB_DATABASE'), $this->getCollectionName());
    }

    abstract protected function getCollectionName(): string;

    public function all()
    {
        return $this->collection->find()->toArray();
    }

    public function find($id)
    {
        return $this->collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
    }

    public function create(array $data)
    {
        return $this->collection->insertOne($data);
    }

    public function update($id, array $data)
    {
        return $this->collection->updateOne(['_id' => new \MongoDB\BSON\ObjectId($id)], ['$set' => $data]);
    }

    public function delete($id)
    {
        return $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
    }
}
