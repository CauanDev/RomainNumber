<?php

class Number {

    private $romanMap = [
        'M' => 1000,
        'CM' => 900, 
        'D' => 500, 
        'CD' => 400,
        'C' => 100, 
        'XC' => 90, 
        'L' => 50, 
        'XL' => 40,
        'X' => 10, 
        'IX' => 9, 
        'V' => 5, 
        'IV' => 4,
        'I' => 1
    ];  
    private $intMap = [
        1000 => 'M', 
        900 => 'CM', 
        500 => 'D', 
        400 => 'CD',
        100 => 'C', 
        90 => 'XC',
        50 => 'L', 
        40 => 'XL',
        10 => 'X', 
        9 => 'IX', 
        5 => 'V', 
        4 => 'IV',
        1 => 'I'
    ];
    public $testCases = [
        ['roman' => 'I', 'integer' => 1],
        ['roman' => 'IV', 'integer' => 4],
        ['roman' => 'IX', 'integer' => 9],
        ['roman' => 'XL', 'integer' => 40],
        ['roman' => 'XC', 'integer' => 90],
        ['roman' => 'C', 'integer' => 100],
        ['roman' => 'CD', 'integer' => 400],
        ['roman' => 'D', 'integer' => 500],
        ['roman' => 'CM', 'integer' => 900],
        ['roman' => 'M', 'integer' => 1000],
        ['roman' => 'MCMLXXXVII', 'integer' => 1987],
        ['roman' => 'MMMCMXC', 'integer' => 3990],
        ['roman' => 'L', 'integer' => 50],
        ['roman' => 'LXV', 'integer' => 65],
        ['roman' => 'LXXXVIII', 'integer' => 88],
        ['roman' => 'CCC', 'integer' => 300],
        ['roman' => 'CCCXL', 'integer' => 340],
        ['roman' => 'CDXLIV', 'integer' => 444],
        ['roman' => 'DCCC', 'integer' => 800],
        ['roman' => 'DCCCXLVIII', 'integer' => 848],
        ['roman' => 'CMXCIX', 'integer' => 999],
        ['roman' => 'MCMXC', 'integer' => 1990],
        ['roman' => 'MMXX', 'integer' => 2020],
        ['roman' => 'MMMCMXCIX', 'integer' => 3999]
    ];
    public function romanToInteger($roman) 
    {
        $num = 0;
        $length = strlen($roman);        
        for ($i = 0; $i < $length; $i++) 
        {
            $current = $this->romanMap[$roman[$i]];
            $next = ($i + 1 < $length) ? $this->romanMap[$roman[$i + 1]] : 0;
            $num += ($current < $next) ? -$current : $current;    
        }
        return $num;
    }
    
    public function integerToRoman($num) 
    {
        $roman = '';
        foreach ($this->intMap as $value => $symbol) 
        {
            while ($num >= $value) 
            {
                $roman .= $symbol;
                $num -= $value;
            }
        }
        return $roman;
    }
    public function tryTests()
    {
        foreach ($this->testCases as $case) 
        {
            $roman = $case['roman'];
            $integer = $case['integer'];
            $resultFromRoman = $this->romanToInteger($roman);
            $resultFromInteger = $this->integerToRoman($integer);
            $romanToIntTest = $resultFromRoman === $integer ? 'Passou' : 'Falhou';
            $intToRomanTest = $resultFromInteger === $roman ? 'Passou' : 'Falhou';
            echo "\nCaso de teste - Romano: $roman, Inteiro: $integer\n";
            echo "Romano para Inteiro: Esperado $integer, Obtido $resultFromRoman - $romanToIntTest\n";
            echo "Inteiro para Romano: Esperado $roman, Obtido $resultFromInteger - $intToRomanTest\n";
        }
    }
    public function newTestCase($roman,$integer)
    {
        $this->testCases[] = ['roman' => $roman, 'integer' => $integer];
    }
}

$number = new Number();
$number->tryTests();

// Metodo que permite adicionar novos testes
// $number->newTestCase('XX',20);
// $number->newTestCase('II', 2);
// $number->newTestCase('III', 3); 
// $number->tryTests();
