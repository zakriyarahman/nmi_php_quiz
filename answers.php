<?php declare(strict_types=1);

// Run Answer 1
// testInputFileWithCalculator();

// Run Answer 4
// echo sumOfMultiples5711();

// Run Answer 6
// getOccurrenceInputFile();

/**
 * Widget Profit Calculator
 *
 * @param  string $purchasePrice
 * @param  string $feePercent
 * @param  string $sellPrice
 * @return string
 */
function widgetProfitCalculator(string $purchasePrice, string $feePercent, string $sellPrice, int $precision = 2): string
{
    return bcadd($sellPrice, bcadd('-' . bcmul($sellPrice, $feePercent, $precision), '-' . $purchasePrice, $precision), $precision);
}

function testInputFileWithCalculator()
{
    $fileContents = file_get_contents('product_costs.txt');
    $counter = 1;
    foreach (explode(PHP_EOL, $fileContents) as $line) {
        list($purchasePrice, $feePercent) = explode(' ', $line);
        echo 'Line ' . $counter . ': ' . widgetProfitCalculator($purchasePrice, 1);

        $counter++;
    }
}

## Answer 2
// SELECT      majors.*,
//             COUNT(students.id) as 'Number of students'
// FROM        majors
// LEFT JOIN   students
//             ON students.major_id = major.id

// GROUP BY    majors.id

## Answer 3
// Either has no purpose because it errors as int x should be int $x
// Or the bitwise & operator evaluates the experssion for even and odd number
// If odd then false else true

## Answer 4
function sumOfMultiples5711(): int
{
    return getMultipleSum(5) + getMultipleSum(7) + getMultipleSum(11);
}

function getMultipleSum(int $number, int $limit=1000): int
{
    $sum = 0;
    for ($i=$number; $i < $limit; $i+=$number) {
        $sum+=$i;
    }
    return $sum;
}

## Answer 6
function getOccurrenceInputFile()
{
    // $fileContents = file_get_contents('sequences.txt');
    // $lines = explode(PHP_EOL, $fileContents);
    $lines = ['aabcc'];
    $numOfLines = count($lines);
    // $needle = 'join the nmi team';
    $needle = 'abc';
    $needlePositions = indexPositions($needle, array_unique(str_split($needle)));
    // Loop through each line
    for ($i=0; $i < $numOfLines; $i++) {
        // Check if line is empty; then skip this round of the loop
        if (empty($lines[$i])) {
            continue;
        }
        // Index the characters and their positions
        $haystackPostions = indexPositions($lines[$i], str_split($needle));
        echo 'Line ' . $i+1 . ': ' . str_pad(
            (string)getOccurrences($needle, $lines[$i], $needlePositions, $haystackPostions),
            5,
            '0',
            STR_PAD_LEFT
        );
    }
}

function indexPositions(string $line, array $keys=[]): array
{
    $arr = str_split($line);
    $length = count($arr);
    $index = [];
    for ($i=0; $i< $length; $i++) {
        // Skip loop if character is not in the needle
        if (!in_array($arr[$i], $keys)) {
            continue;
        }
        // Make new array if character is not assigned in index
        if ($index[$arr[$i]] == null) {
            $index[$arr[$i]] = [];
        }
        // Push the position to the indexed character keys array list
        array_push($index[$arr[$i]], $i);
    }
    // Time complexity O(n)
    return $index;
}

function getOccurrences(string $needle, string $haystack, array $nPosI, array $hPosI): int
{
    $nChars = str_split($needle);
    $combinations = [];
    // Weed out the $haystack if the following
    foreach ($nChars as $nChar) {
        // Check if the char exists in the haystack then combination doesn't exists
        if ($hPosI[$nChar] == null) {
            return 0;
        }
        // Check if the needles char position array length is not
        // equal or lesser than haystacks char position length
        // For example needle is aabc, then char a's position
        // array length should be 2 or greater
        if (count($nPosI[$nChar]) > count($hPosI[$nChar])) {
            return 0;
        }
        // Traverse through and find all combinations regardless of the placements
        array_push($combinations, $hPosI[$nChar]);
    }
    // Make all permutation combinations of indexes
    $result = combos($combinations);
    // Filter the results which only have sequential order array
    foreach ($result as $key => $combination) {
        if (!sequentialIndexes($combination, count($combination))) {
            unset($result[$key]);
        }
    }
    // var_dump($result);
    return count($result);
}

function combos(array $data, array &$all = array(), array $group = array(), ?int $val = null, int $i = 0): array
{
    if (isset($val)) {
        array_push($group, $val);
    }
    if ($i >= count($data)) {
        array_push($all, $group);
    } else {
        foreach ($data[$i] as $v) {
            combos($data, $all, $group, $v, $i + 1);
        }
    }
    return $all;
}

function sequentialIndexes(array $arr, int $index): bool
{
    if ($index == 1 || $index == 0) {
        return true;
    }
    if ($arr[$index-1] < $arr[$index-2]) {
        return false;
    }
    return sequentialIndexes($arr, $index-1);
}
