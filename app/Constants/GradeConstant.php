<?php


namespace App\Constants;


class GradeConstant
{
    const A = 'A';
    const B = 'B';
    const C = 'C';
    const D = 'D';
    const ABS = 'Abs';
    const EXPELLED = 'Expelled';

    const GRADES = [self::A => self::A, self::B => self::B, self::C => self::C,  self::D => self::D, self::ABS => self::ABS, self::EXPELLED => self::EXPELLED];
}
