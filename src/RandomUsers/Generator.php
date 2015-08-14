<?php

Namespace RandomUsers
{
    define ('API_URL', 'http://api.randomuser.me');

    USE GuzzleHttp\Client,
        RandomUsers\User;

    Class Generator
    {

        protected   $json   = null,
                    $data   = [];

        private     $client = null;

        public function __construct()
        {
            $this->client = New Client([
                'base_uri' => API_URL,
                'timeout'  => 2.0,
            ]);

            $this->headers = [
                'query' => [
                    'format' => 'json',
                ]
            ];
        }

        // Facade methods
        public function getMale()
        {
            return array_pop($this->getUsers(1, User::MALE));
        }

        public function getFemale()
        {
            return array_pop($this->getUsers(1, User::FEMALE));
        }

        public function getMales($amount)
        {
            return $this->getUsers($amount, User::MALE);
        }

        public function getFemales($amount)
        {
            return $this->getUsers($amount, User::FEMALE);
        }


        // Worker methods
        public function getUsers($amount = 1, $type = null)
        {
            $this->headers['query']['results'] = $amount;

            if (! is_null($type))
            {
                $this->headers['query']['gender'] = $type;
            }

            $response = $this->client->get('/', $this->headers)->getBody()->getContents();
            $this->setResponse($response);

            $data = [];
            foreach ($this->data AS $response)
            {
                $data[] = $this->mapUser($response->user);
            }

            return $data;
        }

        private function mapUser($response)
        {
print_r($response);
die;
            $user = New User();
            $user->setEmail($response->email)
                 ->setGender($response->gender)
                 ->setFirstName($response->name->first)
                 ->setLastName($response->name->last)
                 ->setStreetAddress($response->location->street)
                 ->setCity($response->location->city)
                 ->setState($response->location->state)
                 ->setZip($response->location->zip)
                 ->setUsername($response->username)
                 ->setPassword($response->password)
                 ->setSalt($response->salt)
                 ->setMd5($response->md5)
                 ->setSha1($response->sha1)
                 ->setSha256($response->sha256)
                 ->setRegistered($response->registered)
                 ->setDateOfBirth($response->dob)
                 ->setPhone($response->phone)
                 ->setCell($response->cell)
                 ->setBSN($response->BSN)
                 ->setPicture($response->picture);

            return $user;
        }

        private function setResponse($rawResponse)
        {
            $this->data   = json_decode($rawResponse)->results;
            $this->json   = $rawResponse;

            return $this;
        }

    }
}