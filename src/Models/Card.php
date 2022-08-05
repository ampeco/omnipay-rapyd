<?php

namespace Ampeco\OmnipayRapyd\Models;

class Card
{
    public ?string $cardType;
    public string $token;
    public ?string $firstSix;
    public string $lastFour;
    public string $month;
    public string $year;

    public function __construct(array $data)
    {
        $this->cardType = $data['bin_details']['brand'] ?? null;
        $this->token = $data['id'];
        $this->firstSix = $data['bin_details']['bin_number'] ?? null;
        $this->month = intval($data['expiration_month']);
        $this->year = 2000 + intval($data['expiration_year']);
        $this->lastFour = $data['last4'];
    }
}
