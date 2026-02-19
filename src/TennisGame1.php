<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private const LOVE = "Love";
    private const FIFTEEN = "Fifteen";
    private const THIRTY = "Thirty";
    private const DEUCE = "Deuce";
    private const FORTY = "Forty";
    private const SEPARADOR = "-";
    private const ALL = "All";
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
            if ($this->scorePlayer1 == 0) {
                return self::LOVE . "" . self::SEPARADOR . self::ALL;
            }
            if ($this->scorePlayer1 == 1) {
                return self::FIFTEEN . self::SEPARADOR . self::ALL;
            }
            if ($this->scorePlayer1 == 2) {
                return self::THIRTY . self::SEPARADOR . self::ALL;
            }
            return self::DEUCE;
        } elseif ($this->scorePlayer1 >= 4 || $this->scorePlayer2 >= 4) {
            $minusResult = $this->scorePlayer1 - $this->scorePlayer2;
            if ($minusResult == 1) {
                return "Advantage player1";
            }
            if ($minusResult == -1) {
                return "Advantage player2";
            }
            if ($minusResult >= 2) {
                return "Win for player1";
            }
            return "Win for player2";

        } else {
            for ($currentPlayer = 1; $currentPlayer <= 2; $currentPlayer++) {
                if ($currentPlayer == 1) {
                    $currentPlayerScore = $this->scorePlayer1;
                } else {
                    $score .= self::SEPARADOR;
                    $currentPlayerScore = $this->scorePlayer2;
                }
                if ($currentPlayerScore == 0) {
                    $score .= self::LOVE;
                }
                if ($currentPlayerScore == 1) {
                    $score .= self::FIFTEEN;
                }
                if ($currentPlayerScore == 2) {
                    $score .= self::THIRTY;
                }
                if ($currentPlayerScore == 3) {
                    $score .= self::FORTY;
                }
            }
        }
        return $score;
    }
}

