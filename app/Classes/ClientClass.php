<?php

namespace App\Classes;
use App\Models\Client;

class ClientClass
{
    public function create($clientData): Client
    {
        return Client::create($clientData);
    }

    public function update($id, $clientData): Client
    {
        $client = Client::find($id);
        return $client->update($clientData);
    }

    public function destroy($id)
    {
        return Client::destroy($id);
    }
}
