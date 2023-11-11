<?php

function getComputerChoice()
{
    $choices = ['rock', 'paper', 'scissors'];
    $randIndex = array_rand($choices);
    return $choices[$randIndex];
}

function determineWinner($userChoice, $computerChoice)
{
    if ($userChoice === $computerChoice) {
        return "It's a tie!";
    } elseif (
        ($userChoice === 'rock' && $computerChoice === 'scissors') ||
        ($userChoice === 'paper' && $computerChoice === 'rock') ||
        ($userChoice === 'scissors' && $computerChoice === 'paper')
    ) {
        return "You win! Your choice: $userChoice, Computer's choice: $computerChoice";
    } else {
        return "Computer wins! Your choice: $userChoice, Computer's choice: $computerChoice";
    }
}

function playGame()
{
    echo "Welcome to Rock, Paper, Scissors!\n";

    while (true) {
        echo "Enter your choice (rock, paper, scissors) or 'quit' to exit: ";
        $userChoice = strtolower(trim(readline()));

        if ($userChoice === 'quit') {
            echo "Thanks for playing! Goodbye!\n";
            break;
        }

        if ($userChoice !== 'rock' && $userChoice !== 'paper' && $userChoice !== 'scissors') {
            echo "Invalid choice. Please choose rock, paper, or scissors.\n";
            continue;
        }

        $computerChoice = getComputerChoice();
        echo "Computer chose: $computerChoice\n";

        $result = determineWinner($userChoice, $computerChoice);
        echo $result . "\n";
    }
}

playGame();
?>
