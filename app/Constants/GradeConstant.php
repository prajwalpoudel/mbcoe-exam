<?php


namespace App\Constants;


class GradeConstant
{
    const A = 'A';
    const AMINUS = 'A-';
    const BPLUS = 'B+';
    const B = 'B';
    const BMINUS = 'B-';
    const CPLUS = 'C+';
    const C = 'C';
    const CMINUS = 'C-';
    const DPLUS = 'D+';
    const D = 'D';
    const DMINUS = 'D-';
    const ABS = 'Abs';
    const FAIL = 'F';
    const CNR = 'Cnr';
    const EXPELLED = 'Expelled';

    const GRADES = [
        self::A => self::A,
        self::AMINUS => self::AMINUS,
        self::BPLUS => self::BPLUS,
        self::B => self::B,
        self::BMINUS => self::BMINUS,
        self::CPLUS => self::CPLUS,
        self::C => self::C,
        self::CMINUS => self::CMINUS,
        self::DPLUS => self::DPLUS,
        self::D => self::D,
        self::ABS => self::ABS,
        self::FAIL => self::FAIL,
        self::CNR => self::CNR,
        self::EXPELLED => self::EXPELLED,
    ];
}
