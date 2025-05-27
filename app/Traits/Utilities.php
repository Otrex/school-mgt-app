<?php

namespace App\Traits;

use App\Models\Community;
use Exception;

trait Utilities
{
    public function grade(int $score): string
    {
        $grade = "";
        try {
            if(!is_integer($score)) {
                throw new Exception("{$score} is not an integer");
            } else {
                switch ($score) {
                    case $score >= 70:
                        $grade = "A";
                        break;

                    case ($score >= 60 && $score <= 69):
                        $grade = "B";
                        break;

                    case ($score >= 50 && $score <= 59):
                        $grade = "C";
                        break;

                    case ($score >= 40 && $score <= 49):
                        $grade = "D";
                        break;
                    default:
                        $grade = "F";
                        break;
                }
            }
        } catch (Exception $e) {
            print "An Exception has occurred!. Message: {$e->getMessage()}";
        }

        return $grade;
    }

    public function generateReferralCode($length = 10) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    public function updateReferralCode(Community $member)
    {
        $referrerCode = $this->generateReferralCode();
        while (Community::where('referrer_code', $referrerCode)->exists()) {
            $referrerCode = $this->generateReferralCode();
        }

        $member->referrer_code = $referrerCode;
        $member->save();
    }
}
