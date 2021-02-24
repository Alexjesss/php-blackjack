<?php
declare(strict_types=1);
include 'includes/autoloader.inc.php';
session_start();

if (!isset($_SESSION['$blackjack'])) {
    $_SESSION['$blackjack'] = new Blackjack();
}

$blackjackGame = $_SESSION['$blackjack'];
$dealerScore = $blackjackGame->getDealer()->getScore();
$playerScore = $blackjackGame->getPlayer()->getScore();


if (isset($_POST['hit'])) {
    $blackjackGame->getPlayer()->hit($blackjackGame->getDeck());
    $blackjackGame->getPlayer()->getScore();
    if ($blackjackGame->getPlayer()->getLost()) {
        Winner($blackjackGame, $playerScore, $dealerScore);

    }
}

if (isset($_POST['surrender'])) {
    $blackjackGame->getPlayer()->surrender();
    unset($_SESSION['$blackjack']);
}

if (isset($_POST['stand'])) {
    $blackjackGame->getDealer()->hit($blackjackGame->getDeck());
    if ($blackjackGame->getDealer()->getLost()) {
        Winner($blackjackGame, $playerScore, $dealerScore);
    }
}

if (isset($_POST['restart'])) {
    unset($_SESSION['$blackjack']);
}

function Winner($blackjackGame, $playerScore, $dealerScore): string
{
    if (($playerScore < Player::WIN_NUMBER && $playerScore > $dealerScore) || $dealerScore > Player::WIN_NUMBER) {
        $blackjackGame->getDealer()->setLost(true);
        unset($_SESSION);
        return "The winner is the player";

    } else if (($playerScore < $dealerScore) || $playerScore > Player::WIN_NUMBER) {
        $blackjackGame->getDealer()->setLost(false);
        unset($_SESSION);
        return "The winner is the dealer";
    } else if ($playerScore == $dealerScore) {
        $blackjackGame->getPlayer()->setLost(true);
        unset($_SESSION);
        return "The winner is the dealer";
    } else {
        $blackjackGame->getPlayer()->setLost(false);
        unset($_SESSION);
        return "The winner is the player";
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
<?php if (isset($_POST['surrender'])):?>
    <h3>Play again?</h3>
    <h2></h2>
    <h1></h1>
    <form></form>
<button type="submit" name="restart">Restart</button>
<?php else:?>
    <h3><?php echo Winner($blackjackGame, $playerScore, $dealerScore);?></h3>
    <h2>Player:<?php echo $blackjackGame->getPlayer()->getScore();?></h2>
    <h2>Dealer:<?php echo $blackjackGame->getDealer()->getScore();?></h2>
    <h1><?php $blackjackGame->getPlayer()->playingCards();?></h1>
    <form method="post">
        <button type="submit" name="hit">Hit</button>
        <button type="submit" name="surrender">Surrender</button>
        <button type="submit" name="stand">Stand</button>
        <button type="submit" name="restart">Restart</button>
    </form>
<?php endif;?>
</body>
</html>
