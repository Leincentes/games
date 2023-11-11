<?php

function playGuessingGame()
{
    echo "Welcome to the Number Guessing Game!\n";
    $min = 1;
    $max = 100;
    $targetNumber = rand($min, $max);
    $attempts = 0;

    while (true) {
        echo "Guess a number between $min and $max: ";
        $guess = intval(readline());
        $attempts++;

        if ($guess < $min || $guess > $max) {
            echo "Please enter a number within the specified range.\n";
        } elseif ($guess < $targetNumber) {
            echo "Go higher!\n";
        } elseif ($guess > $targetNumber) {
            echo "Go lower!\n";
        } else {
            echo "Congratulations! You guessed the number $targetNumber in $attempts attempts!\n";
            break;
        }
    }

    echo "Do you want to play again? (yes/no): ";
    $playAgain = strtolower(trim(readline()));
    if ($playAgain === 'yes') {
        playGuessingGame();
    } else {
        echo "Thanks for playing! Goodbye!\n";
    }
}

playGuessingGame();
?>
