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

    public function surrender() :void
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

    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function hit(Deck $deck) :void
    {
        if ($this->getScore() > self::WIN_NUMBER) {
            $this->lost = true;
        } else {
            $this->$deck->drawCard();
        }
    }


}