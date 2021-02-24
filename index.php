<?php
declare(strict_types=1);
include 'includes/autoloader.inc.php';
session_start();

if (!isset($_SESSION['$blackjack'])) {
    $_SESSION['$blackjack'] = new Blackjack();
}

$blackjackGame = $_SESSION['$blackjack'];


// If he is not lost, compare scores to set the winner (If equal the dealer wins).

//1. Always display on the page the scores of both players. If you have a winner, display it.
//1. End of the game: destroy the current `blackjack` variable so the game restarts.

if (isset($_POST['hit'])) {
    $blackjackGame->getDeck()->drawCard();
    if ($blackjackGame->getScore() > Player::WIN_NUMBER){
        $blackjackGame->Winner();
    }
}

if (isset($_POST['surrender'])) {
    $blackjackGame->getPlayer()->surrender();
}

if (isset($_POST['stand'])) {
    $blackjackGame->getDealer()->hit($blackjackGame->getDeck());
    $blackjackGame->Winner();
    if ($blackjackGame->getDealer()->getLost()) {
        $blackjackGame->Winner();
    }
}

function Winner($blackjackGame)
{
    if ($blackjackGame->getPlayer()->getScore() < Player::WIN_NUMBER || $blackjackGame->getPlayer()->getScore() > $blackjackGame->getDealer()->getScore()) {
        $blackjackGame->getDealer()->setLost(true);
    } else if ($blackjackGame->getPlayer()->getScore() < Player::WIN_NUMBER || $blackjackGame->getPlayer()->getScore() < $blackjackGame->getDealer()->getScore()) {
        $blackjackGame->getDealer()->setLost(false);
    } else if ($blackjackGame->getPlayer()->getScore() > Player::WIN_NUMBER || $blackjackGame->getPlayer()->getScore() === $blackjackGame->getDealer()->getScore()) {
        $blackjackGame->getPlayer()->setLost(true);
    } else {
        $blackjackGame->getPlayer()->setLost(false);
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blackjack game</title>
</head>
<body>
<h3><?php echo "The winner is" . " " ?></h3>
<h2>Player:<?php echo $blackjackGame->getPlayer()->getScore(); ?></h2>
<h2>Dealer:<?php echo $blackjackGame->getDealer()->getScore(); ?></h2>
<h1><?php $blackjackGame->getPlayer()->playingCards(); ?></h1>
<form method="post">
    <button type="submit" name="hit">Hit</button>
    <button type="submit" name="surrender">Surrender</button>
    <button type="submit" name="stand">Stand</button>
</form>
</body>
</html>
