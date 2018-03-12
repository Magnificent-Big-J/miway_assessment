<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/12
 * Time: 10:08 AM
 */

class Dueling_Generators
{

    /**
     * Dueling_Generators constructor.
     */
    protected $generatorA;
    protected $generatorB;
    protected $dataSource;
    protected $data =array();
    public function __construct()
    {
        $this->prepareData();
    }
    protected function prepareData()
    {
        $this->dataSource = file_get_contents('input2.txt');
        $lines = explode("\n", $this->dataSource);
        foreach($lines as $word) {

            if (strpos($word, 'Generator A') !== false) {
                $word = str_replace("Generator A starts with"," ",$word);
                $this->data[] = $word;
            }
            if (strpos($word, 'Generator B') !== false) {
                $word = str_replace("Generator B starts with"," ",$word);
                $this->data[] = $word;
            }
        }

    }
    public function judge()
    {
        $this->generatorA = $this->data[0];
        $this->generatorB = $this->data[1];
        $size = 40000000;
        $total = 0;

        for($i = 0; $i<$size; $i++)
        {
            $this->generatorA = $this->A_generator($this->generatorA);
            $this->generatorB = $this->B_generator($this->generatorB);
            $bin_a =  $this->convertDecimalToBinary($this->generatorA);
            $bin_b = $this->convertDecimalToBinary($this->generatorB);
            $bin_a = substr($bin_a,-16);
            $bin_b = substr($bin_b,-16);

            if($bin_a == $bin_b)
            {
                $total++;
            }
        }

        return $total;
    }

    protected function A_generator($val)
    {
        $bin_output =  $val * 16807 % 2147483647;

        return $bin_output;
    }
    protected function B_generator($val)
    {
        $bin_output = $val * 48271 % 2147483647;

        return $bin_output;
    }
    protected function convertDecimalToBinary($val)
    {
        $bin_val = decbin($val);
        return (string)$bin_val;
    }
}