<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private int $scorePlayer1 = 0;
    private int $scorePlayer2 = 0;
    private string $player1Name = '';
    private string $player2Name = '';

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName): void
    {
        if ('player1' == $playerName) {
            $this->scorePlayer1++;
        } else {
            $this->scorePlayer2++;
        }
    }

    public function getScore(): string
    {
        $score = "";
        if ($this->scorePlayer1 == $this->scorePlayer2) {
            switch ($this->scorePlayer1) {
                case 0:
                    $score = "Love-All";
                    break;
                case 1:
                    $score = "Fifteen-All";
                    break;
                case 2:
                    $score = "Thirty-All";
                    break;
                default:
                    $score = "Deuce";
                    break;
            }
        } elseif ($this->scorePlayer1 >= 4 || $this->scorePlayer2 >= 4) {
            $minusResult = $this->scorePlayer1 - $this->scorePlayer2;
            if ($minusResult == 1) {
                $score = "Advantage player1";
            } elseif ($minusResult == -1) {
                $score = "Advantage player2";
            } elseif ($minusResult >= 2) {
                $score = "Win for player1";
            } else {
                $score = "Win for player2";
            }
        } else {
            for ($i = 1; $i < 3; $i++) {
                if ($i == 1) {
                    $tempScore = $this->scorePlayer1;
                } else {
                    $score .= "-";
                    $tempScore = $this->scorePlayer2;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= "Love";
                        break;
                    case 1:
                        $score .= "Fifteen";
                        break;
                    case 2:
                        $score .= "Thirty";
                        break;
                    case 3:
                        $score .= "Forty";
                        break;
                }
            }
        }
        return $score;
    }
}

