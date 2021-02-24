<?php
include 'includes/autoloader.inc.php';
session_start();

if (!isset($_SESSION['$blackjack'])){
    $blackjack = new Blackjack();
    $_SESSION = $blackjack;
}

// When you the **hit** button call `hit` on player, then check the lost status of the player.
//    You will need to pass a `Deck` variable to this function, you can use the `Blackjack::getDeck()` method for this.
//1. When you the **stand** button call `hit` on dealer, then check the lost status of the dealer. If he is not lost, compare scores to set the winner (If equal the dealer wins).
//1. **Surrender**: the dealer auto wins.
//1. Always display on the page the scores of both players. If you have a winner, display it.
//1. End of the game: destroy the current `blackjack` variable so the game restarts.

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

<form method="post">
<button type="submit" name="hit" >Hit</button>
<button type="submit" name="surrender">Surrender</button>
<button type="submit" name="stand">Stand</button>
</form>

</body>
</html>
