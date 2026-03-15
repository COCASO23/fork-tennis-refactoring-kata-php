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
    private string $player1Name;
    private string $player2Name;

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName): void
    {
        if ('player1' == $playerName) {
            $this->scorePlayer1++;
        }
        if ('player2' == $playerName) {
            $this->scorePlayer2++;
        }
    }

    public function getScore(): string
    {

        if ($this->isDraw()) {
            return $this->getDrawResult();
        }
        if ($this->somePlayerHasAdvantage()) {
            $scoreDifferencePlayer1Player2 = $this->scorePlayer1 - $this->scorePlayer2;
            return $this->getAdvantageOrWin($scoreDifferencePlayer1Player2);
        }
        $score = "";
        for ($currentPlayer = 1; $currentPlayer <= 2; $currentPlayer++) {
            if ($currentPlayer == 1) {
                $currentPlayerScore = $this->scorePlayer1;
            }
            if ($currentPlayer == 2) {
                $score .= self::SEPARADOR;
                $currentPlayerScore = $this->scorePlayer2;
            }
            $score = $this->getCurrentPlayerScore($currentPlayerScore, $score);
        }
        return $score;
    }

    /**
     * @return bool
     */
    public function isDraw(): bool
    {
        return $this->scorePlayer1 == $this->scorePlayer2;
    }

    /**
     * @return string
     */
    public function getDrawResult(): string
    {
        if ($this->scorePlayer1 == 0) {
            return self::LOVE . self::SEPARADOR . self::ALL;
        }
        if ($this->scorePlayer1 == 1) {
            return self::FIFTEEN . self::SEPARADOR . self::ALL;
        }
        if ($this->scorePlayer1 == 2) {
            return self::THIRTY . self::SEPARADOR . self::ALL;
        }
        return self::DEUCE;
    }

    /**
     * @return bool
     */
    public function somePlayerHasAdvantage(): bool
    {
        return $this->scorePlayer1 >= 4 || $this->scorePlayer2 >= 4;
    }

    /**
     * @param int $currentPlayerScore
     * @param string $score
     * @return string
     */
    public function getCurrentPlayerScore(int $currentPlayerScore, string $score): string
    {
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
        return $score;
    }

    /**
     * @param int $scoreDifferencePlayer1Player2
     * @return string
     */
    public function getAdvantageOrWin(int $scoreDifferencePlayer1Player2): string
    {
        if($this->aPlayerHasAdvantage($scoreDifferencePlayer1Player2)){
            if ($this->player1HasAdvantage($scoreDifferencePlayer1Player2)) {
                return "Advantage player1";
            }
            return "Advantage player2";
        }
        return $this->getWinner($scoreDifferencePlayer1Player2);
    }

    /**
     * @param int $scoreDifferencePlayer1Player2
     * @return bool
     */
    public function aPlayerHasAdvantage(int $scoreDifferencePlayer1Player2): bool
    {
        return $scoreDifferencePlayer1Player2 == 1 || $scoreDifferencePlayer1Player2 == -1;
    }

    /**
     * @param int $scoreDifferencePlayer1Player2
     * @return bool
     */
    public function player1HasAdvantage(int $scoreDifferencePlayer1Player2): bool
    {
        return $scoreDifferencePlayer1Player2 == 1;
    }

    /**
     * @param int $scoreDifferencePlayer1Player2
     * @return string
     */
    public function getWinner(int $scoreDifferencePlayer1Player2): string
    {
        if ($scoreDifferencePlayer1Player2 >= 2) {
            return "Win for player1";
        }
        return "Win for player2";
    }
}

