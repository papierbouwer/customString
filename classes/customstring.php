<?php

class customString
{
	private $value,
	$frequentieTable,
	$filterWithout,
	$filterWith,
	$words,
	$urls,
	$hashtags,
	$users,
	$length;

	function customString($inputValue)
	{
		$this->value = $inputValue;
		$this->length = strlen($this->value);
	}

	function filterWithout($filterWords)
	{
		$filter = [];
		foreach($filterWords as $word)
		{
			array_push($filter, strtolower($word));
		}
		$this->filterWithout = $filter;
		return $this;
	}

	function filterWith($filterWords)
	{
		$filter = [];
		foreach($filterWords as $word)
		{
			array_push($filter, strtolower($word));
		}
		$this->filterWith = $filter;
		return $this;
	}

	private function setWords()
	{
		$this->words = array();
		$this->hashtags = array();
		$this->urls = array();
		$this->users = array();

		$tempWords = explode(" ", $this->value);

		foreach($tempWords as $word)
		{
			$word = stripslashes($word);

			if(filter_var($word, FILTER_VALIDATE_URL))
			array_push($this->urls, $word);
			else
			{
				if($word[0] == "#")
				{
					$word = preg_replace('/[^ \w]+/', "", $word);
					array_push($this->hashtags, $this->utf8_for_print($word));
				} elseif($word[0] == "@")
				array_push($this->users, $this->utf8_for_print($word));

				$word = strtolower($word);
				$word = preg_replace('/[^ \w]+/', "", $word);
				array_push($this->words, $this->utf8_for_print($word));
			}
		}
	}

	private function setFrequentieTable()
	{
		$this->frequentieTable = array();

		foreach($this->words as $word)
		{
			if(count($this->filterWith) > 0)
			{
				if(!empty($this->filterWithout))
				{
					if(in_array($word, $this->filterWith) && !in_array($word, $this->filterWithout))
					{
						$this->countWord($word);
					}
				}
				else {
					if(in_array($word, $this->filterWith))
					{
						$this->countWord($word);
					}
				}
			}
			else
			{
				if(!empty($this->filterWithout))
				{
					if(!in_array($word, $this->filterWithout))
					{
						$this->countWord($word);
					}
				}
				else {
					$this->countWord($word);
				}
			}
		}
	}

	function getHashtags()
	{
		$this->sortArrays();
		return $this->hashtags;
	}

	function getUrls()
	{
		$this->sortArrays();
		return $this->urls;
	}

	function getUsers()
	{
		$this->sortArrays();
		return $this->users;
	}

	function getFrequentieTable()
	{
		$this->setWords();
		$this->setFrequentieTable();
		$this->sortArrays();
		return $this->frequentieTable;
	}

	private function sortArrays()
	{
		sort($this->users, SORT_NATURAL);
		sort($this->hashtags, SORT_NATURAL);
		sort($this->urls, SORT_NATURAL);
		arsort($this->frequentieTable, SORT_NUMERIC);
	}

	private function utf8_for_print($string)
	{
		$string =  htmlspecialchars($string, ENT_NOQUOTES, "UTF-8");
		return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u',
		' ', $string);
	}

	private function countWord($word) {
		if(isset($this->frequentieTable[$word]))
		{
			$this->frequentieTable[$word]++;
		}
		else
		{
			$this->frequentieTable[$word] = 1;
		}
	}
}

?>
