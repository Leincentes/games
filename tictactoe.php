<?php

function initializeBoard()
{
    return [
        [' ', ' ', ' '],
        [' ', ' ', ' '],
        [' ', ' ', ' ']
    ];
}

function displayBoard($board)
{
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo $board[$i][$j];
            if ($j < 2) {
                echo '|';
            }
        }
        echo "\n";
        if ($i < 2) {
            echo "-----\n";
        }
    }
}

function checkWin($board, $player)
{
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] == $player && $board[$i][1] == $player && $board[$i][2] == $player) {
            return true;
        }
        if ($board[0][$i] == $player && $board[1][$i] == $player && $board[2][$i] == $player) {
            return true;
        }
    }
    if ($board[0][0] == $player && $board[1][1] == $player && $board[2][2] == $player) {
        return true;
    }
    if ($board[0][2] == $player && $board[1][1] == $player && $board[2][0] == $player) {
        return true;
    }
    return false;
}

function isBoardFull($board)
{
    foreach ($board as $row) {
        if (in_array(' ', $row)) {
            return false;
        }
    }
    return true;
}

function playGame()
{
    echo "Welcome to Tic-Tac-Toe!\n";
    
    while (true) {
        $board = initializeBoard();
        $currentPlayer = 'X';

        while (true) {
            displayBoard($board);

            echo "Player $currentPlayer's turn. Enter row (1-3) and column (1-3): ";
            $input = readline();
            $input = explode(' ', $input);
            $row = intval($input[0]) - 1;
            $col = intval($input[1]) - 1;

            if ($row < 0 || $row > 2 || $col < 0 || $col > 2 || $board[$row][$col] !== ' ') {
                echo "Invalid input. Try again.\n";
                continue;
            }

            $board[$row][$col] = $currentPlayer;

            if (checkWin($board, $currentPlayer)) {
                displayBoard($board);
                echo "Player $currentPlayer wins!\n";
                break;
            }

            if (isBoardFull($board)) {
                displayBoard($board);
                echo "It's a tie!\n";
                break;
            }

            $currentPlayer = ($currentPlayer === 'X') ? 'O' : 'X';
        }

        echo "Do you want to play again? (yes/no): ";
        $playAgain = strtolower(readline());
        if ($playAgain !== 'yes') {
            echo "Thanks for playing! Goodbye!\n";
            break;
        }
    }
}

playGame();
?>
