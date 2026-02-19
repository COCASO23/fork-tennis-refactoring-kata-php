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
            switch ($this->scorePlayer1) {
                case 0:
                    $score = self::LOVE . "" . self::SEPARADOR . self::ALL;
                    break;
                case 1:
                    $score = self::FIFTEEN . self::SEPARADOR . self::ALL;
                    break;
                case 2:
                    $score = self::THIRTY . self::SEPARADOR . self::ALL;
                    break;
                default:
                    $score = self::DEUCE;
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
                    $score .= self::SEPARADOR;
                    $tempScore = $this->scorePlayer2;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= self::LOVE;
                        break;
                    case 1:
                        $score .= self::FIFTEEN;
                        break;
                    case 2:
                        $score .= self::THIRTY;
                        break;
                    case 3:
                        $score .= self::FORTY;
                        break;
                }
            }
        }
        return $score;
    }
}

