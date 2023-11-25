<?php

class BlackjackGame
{
    private $deck;
    private $playerHand;
    private $dealerHand;

    public function __construct()
    {
        $this->deck = $this->createDeck();
        $this->playerHand = [];
        $this->dealerHand = [];
    }

    private function createDeck()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

        $deck = [];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $deck[] = ['rank' => $rank, 'suit' => $suit];
            }
        }

        shuffle($deck);

        return $deck;
    }

    private function dealCard(&$hand)
    {
        $card = array_shift($this->deck);
        $hand[] = $card;
    }

    private function calculateHandValue($hand)
    {
        $value = 0;
        $aceCount = 0;

        foreach ($hand as $card) {
            $rank = $card['rank'];

            if ($rank === 'Ace') {
                $aceCount++;
                $value += 11;
            } elseif (in_array($rank, ['King', 'Queen', 'Jack'])) {
                $value += 10;
            } else {
                $value += intval($rank);
            }
        }

        // Handle Aces
        while ($aceCount > 0 && $value > 21) {
            $value -= 10;
            $aceCount--;
        }

        return $value;
    }

    private function displayHand($hand, $showAllCards = true)
    {
        foreach ($hand as $card) {
            echo ($showAllCards) ? $card['rank'] . ' of ' . $card['suit'] . "\n" : "Card\n";
        }
    }

    public function startGame()
    {
        echo "Welcome to Blackjack!\n";

        $this->dealCard($this->playerHand);
        $this->dealCard($this->dealerHand);
        $this->dealCard($this->playerHand);
        $this->dealCard($this->dealerHand);

        $this->playPlayerTurn();
        $this->playDealerTurn();

        $this->displayResults();
    }

    private function playPlayerTurn()
    {
        echo "Player's Turn:\n";

        while ($this->calculateHandValue($this->playerHand) < 21) {
            echo "Your Hand:\n";
            $this->displayHand($this->playerHand);

            echo "Do you want to hit or stand? (h/s): ";
            $choice = strtolower(trim(readline()));

            if ($choice === 'h') {
                $this->dealCard($this->playerHand);
            } elseif ($choice === 's') {
                break;
            } else {
                echo "Invalid choice. Please enter 'h' or 's'.\n";
            }
        }
    }

    private function playDealerTurn()
    {
        echo "Dealer's Turn:\n";

        while ($this->calculateHandValue($this->dealerHand) < 17) {
            $this->dealCard($this->dealerHand);
        }

        echo "Dealer's Hand:\n";
        $this->displayHand($this->dealerHand, true);
    }

    private function displayResults()
    {
        echo "\nResults:\n";

        echo "Your Hand:\n";
        $this->displayHand($this->playerHand, true);
        $playerValue = $this->calculateHandValue($this->playerHand);
        echo "Your Total: $playerValue\n";

        echo "\nDealer's Hand:\n";
        $this->displayHand($this->dealerHand, true);
        $dealerValue = $this->calculateHandValue($this->dealerHand);
        echo "Dealer's Total: $dealerValue\n";

        if ($playerValue > 21 || ($dealerValue <= 21 && $dealerValue >= $playerValue)) {
            echo "Dealer wins!\n";
        } else {
            echo "You win!\n";
        }
    }
}

// Start the game
$blackjackGame = new BlackjackGame();
$blackjackGame->startGame();
?>
