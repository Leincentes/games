<?php

function chooseRandomWord()
{
    $words = ['hangman', 'programming', 'computer', 'php', 'javascript', 'developer', 'coding'];
    $randIndex = array_rand($words);
    return strtolower($words[$randIndex]);
}

function displayWord($word, $guessedLetters)
{
    $display = '';
    foreach (str_split($word) as $letter) {
        if (in_array($letter, $guessedLetters)) {
            $display .= $letter . ' ';
        } else {
            $display .= '_ ';
        }
    }
    return $display;
}

function playHangman()
{
    echo "Welcome to Hangman!\n";

    $wordToGuess = chooseRandomWord();
    $guessedLetters = [];
    $maxAttempts = 6;
    $attempts = 0;

    while ($attempts < $maxAttempts) {
        $display = displayWord($wordToGuess, $guessedLetters);
        echo "Word: $display\n";
        echo "Guessed Letters: " . implode(', ', $guessedLetters) . "\n";

        echo "Enter a letter: ";
        $guess = strtolower(trim(readline()));

        if (strlen($guess) !== 1 || !ctype_alpha($guess)) {
            echo "Invalid input. Please enter a single letter.\n";
            continue;
        }

        if (in_array($guess, $guessedLetters)) {
            echo "You already guessed that letter. Try again.\n";
            continue;
        }

        $guessedLetters[] = $guess;

        if (strpos($wordToGuess, $guess) === false) {
            echo "Incorrect guess. ";
            $attempts++;
        } else {
            echo "Good guess! ";
        }

        $remainingAttempts = $maxAttempts - $attempts;
        echo "Attempts left: $remainingAttempts\n";

        if (strpos(displayWord($wordToGuess, $guessedLetters), '_') === false) {
            echo "Congratulations! You guessed the word: $wordToGuess\n";
            break;
        }
    }

    if ($attempts === $maxAttempts) {
        echo "Sorry, you ran out of attempts. The word was: $wordToGuess\n";
    }
}

playHangman();
?>
