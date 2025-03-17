<?php

namespace Ampeco\OmnipayRapyd\Message;

use Ampeco\OmnipayRapyd\Models\Card;

class ListPaymentMethodsResponse extends Response
{
    const TYPE_CARD = 'card';

    private $cards;

    /**
     * @return Card[]
     */
    public function getCards()
    {
        if (!empty($this->cards)) {
            return $this->cards;
        }

        $cards = array_filter(
            $this->data['data'] ?? [],
            fn ($card) => $card['category'] === self::TYPE_CARD && !empty($card['id'])
        );

        return $this->cards = array_map(fn ($card) => new Card($card), $cards);
    }

    public function setCards(array $cards): self
    {
        $this->cards = $cards;
        return $this;
    }
}
