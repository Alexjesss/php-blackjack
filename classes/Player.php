<?php
declare(strict_types=1);

class Player
{
    private array $cards = [];
    private bool $lost = false;
    public const WIN_NUMBER = 21;

    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
    }

    public function surrender(): void
    {
        $this->lost = true;
    }

    public function getScore(): int
    {
        $score = 0;
        foreach ($this->cards as $card) {
            $score += $card->getValue();
        }
        return $score;
    }

    public function getLost(): bool
    {
        return $this->lost;
    }

    public function setLost(bool $lost): void
    {
        $this->lost = $lost;
    }



    public function hit(Deck $deck): void
    {
        $this->cards[] = $deck->drawCard();
        if ($this->getScore() > self::WIN_NUMBER) {
            $this->lost = true;
        }
    }

    public function playingCards(): void
    {
        foreach ($this->cards as $card) {
            echo $card->getUnicodeCharacter(true);
        }
    }

    public function stand() :void
    {

    }
}

class Dealer extends Player
{

    public const DEALER_NUMBER = 15;

    public function hit(Deck $deck): void
    {
        parent::hit($deck);
        while ($this->getScore() < self::DEALER_NUMBER) {
            $this->stand();

        }
    }
}
