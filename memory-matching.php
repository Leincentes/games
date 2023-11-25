<?php

function initializeBoard()
{
    $symbols = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    $shuffledSymbols = array_merge($symbols, $symbols);
    shuffle($shuffledSymbols);

    $board = [];
    for ($i = 0; $i < 4; $i++) {
        $row = [];
        for ($j = 0; $j < 4; $j++) {
            $row[] = $shuffledSymbols[$i * 4 + $j];
        }
        $board[] = $row;
    }

    return $board;
}

function displayBoard($board, $revealed)
{
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            if ($revealed[$i][$j]) {
                echo $board[$i][$j];
            } else {
                echo '*';
            }
            echo ' ';
        }
        echo "\n";
    }
}

function playMemoryGame()
{
    echo "Welcome to the Memory Matching Game!\n";

    $board = initializeBoard();
    $revealed = array_fill(0, 4, array_fill(0, 4, false));
    $attempts = 0;

    while (true) {
        displayBoard($board, $revealed);

        echo "Enter the row (1-4) and column (1-4) to reveal a card (e.g., 2 3): ";
        $input = readline();
        $input = explode(' ', $input);
        $row = intval($input[0]) - 1;
        $col = intval($input[1]) - 1;

        if ($row < 0 || $row >= 4 || $col < 0 || $col >= 4 || $revealed[$row][$col]) {
            echo "Invalid input. Try again.\n";
            continue;
        }

        $revealed[$row][$col] = true;
        displayBoard($board, $revealed);

        echo "Enter the row (1-4) and column (1-4) to reveal another card: ";
        $input = readline();
        $input = explode(' ', $input);
        $row2 = intval($input[0]) - 1;
        $col2 = intval($input[1]) - 1;

        if ($row2 < 0 || $row2 >= 4 || $col2 < 0 || $col2 >= 4 || $revealed[$row2][$col2]) {
            echo "Invalid input. Try again.\n";
            $revealed[$row][$col] = false; // Flip the first card back
            continue;
        }

        $revealed[$row2][$col2] = true;
        displayBoard($board, $revealed);

        if ($board[$row][$col] !== $board[$row2][$col2]) {
            echo "No match. Try again.\n";
            $revealed[$row][$col] = false;
            $revealed[$row2][$col2] = false;
        } else {
            echo "Match found!\n";
        }

        $attempts++;

        // Check if all cards are revealed
        if (array_sum(array_map('array_sum', $revealed)) === 16) {
            echo "Congratulations! You completed the game in $attempts attempts!\n";
            break;
        }
    }
}

playMemoryGame();
?>
