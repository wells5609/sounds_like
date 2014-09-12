<?php
/**
 * @package wells5609/sounds_like
 */

/**
 * Checks if two text strings have similar pronunciation.
 *
 * The function takes the metaphone of both strings, computes the Levenshtein
 * distance between them, and then computes the distance as a percentage of
 * the first argument's metaphone key string length.
 *
 * Inspired by a 10-year old comment on PHP.net...
 *
 * @link http://us3.php.net/manual/en/function.metaphone.php#39076
 *
 * @example
 * $str1 = 'I was born on a Wednesday in Mid-December';
 * $str2 = 'I was bored on a weekday late last fall';
 * sounds_like($str1, $str2); // returns true, as similarity 0.52... >= 0.5
 *
 * @param string $str1 First string. The "compare to" string.
 * @param string $str2 Second string. The "comparison" string.
 * @param float $error [Optional] Minimum similarity to accept. Default 0.5 (50% similarity).
 * @param array &$info [Optional] Array populated with information used to compute the similarity.
 *
 * @return boolean TRUE if the strings' computed similarity is equal to or above the accepted
 * similarity, otherwise FALSE.
 */
function sounds_like($str1, $str2, $error = 0.5, array &$info = null) {

	$info = array(
		'metaphone_1' => $meta1 = metaphone($str1),
		'metaphone_2' => $meta2 = metaphone($str2),
		'distance' => $lev = levenshtein($meta1, $meta2),
		'similarity' => $similarity = $lev/strlen($meta1)
	);

	return ($similarity >= $error);
}
