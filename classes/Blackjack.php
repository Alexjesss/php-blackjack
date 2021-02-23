<?php
declare(strict_types=1);

class Blackjack
{
        private Player $player;
        private Player $dealer;
        private Deck $Deck;


    public function __construct()
    {
        $this->player = new Player($this->getDeck());
        $this->dealer = new Player($this->getDeck());
        $this->deck = new Deck();
        $this->deck->shuffle();

    }


    public function setPlayer($player): void
    {
        $this->player = $player;
    }


    public function setDealer($dealer): void
    {
        $this->dealer = $dealer;
    }


    public function setDeck($Deck): void
    {
        $this->Deck = $Deck;
    }



    public function getPlayer()
    {
        return $this->player;
    }

    public function getDealer()
    {
        return $this->dealer;
    }

    public function getDeck()
    {
        return $this->Deck;
    }




}