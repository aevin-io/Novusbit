<?
/**
 * @package Text class
 * @uses This class can extract keywords from text file
 */
class Textanalysis_Model extends CI_Model
{
	/**
	 * Source text
	 *
	 * @var String
	 */
	private $text = '';

	/**
	 * All words
	 *
	 * @var Array
	 */
	private $words = '';

	/**
	 * Preparation
	 *
	 * @param $text_file String
	 * @param $min_strlen Int
	 */
	public function load_textfile ($text_file)
	{
	
	/*
		if (file_exists ($text_file))
		{
		$this->text = file_get_contents ($text_file);
		}
		else
		{
			throw new Exception("File $text_file not found");
		}
	*/
	
		$this->text = $text_file;
	$this->text2words ();
	$this->gen_words ();
	}

	/**
	 * Convert text to array of words
	 */
	private function text2words ()
	{
	preg_match_all ('/(\w+)/i', $this->text, $this->words);
	$this->words = $this->words ['0'];
	    
	$filtered_words = array_filter( $this->words, "filter");	
	$this->words = $filtered_words;
	
	}

	/**
	 * Returns words from array of words
	 *
	 */
	private function gen_words ()
	{
	$this->words = array_count_values ($this->words);
	arsort ($this->words);
	}

	/**
	 * Returns elements from $a to $b
	 *
	 * @param $a Int
	 * @param $b Int
	 * @return Array|false
	 */
	public function get_limit ($a, $b)
	{
		if ((int) $b==="0")
		{
			return false;
		}

		return array_slice ($this->words, (int) $a, $b);
	}

	/**
	 * Returns elements frequency > $a
	 *
	 * @param $a Int Frequency
	 * @return Array
	 */
	public function get_count_limit ($a)
	{
		$temp = array();
	$a = (int) $a;
		foreach ($this->words as $key=>$value)
		{
			if ($value >= $a)
			{
			$temp[$key] = $value;
			}
			else
			{
				break;
			}
		}

		return $temp;
		
	}

	/**
	 * Returns all words
	 *
	 * @return Array
	 */
	public function get_all ()
	{
		return $this->words;
	}
	
}