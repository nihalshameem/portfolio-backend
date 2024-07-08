<?php

namespace App\Models;

use App\Models\MongoModel;
use MongoDB\Client;

class ContactMe extends MongoModel
{
    protected function getCollectionName(): string
    {
        return 'contac_me';
    }
}
