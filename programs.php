<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/08
 * Time: 12:48 PM
 */

class programs
{

    protected $dataSource;
    protected $data = array();
    protected $checked_nodes = array();


    /**
     * programs constructor.
     */
    public function __construct()
    {
        $this->dataSource = file_get_contents('input.txt');
        $this->prepareData();

    }
    protected function prepareData()
    {
        $lines = explode("\n", $this->dataSource);

        foreach($lines as $word) {
            $temp = explode("<->",$word);
            $this->data[(int)$temp[0]] = explode(",", $temp[1]);
        }
    }
    public function allProgrammesConnectToZero()
    {

        $this->checked_nodes[] = 0;
       foreach ($this->data as $dd)
        {
           $this->get_links($dd);
        }


        return count($this->checked_nodes);

    }
    protected function get_links($list)
    {
        $count_list = count($list);

        for($i = 0; $i<$count_list;$i++)
        {
            $node = $list[$i];
            $curr_node_list = $this->get_node_line((int)$node);
            $n_count = count($curr_node_list);

            if(in_array(0,$curr_node_list))
            {
                if(!in_array((int)$node,$this->checked_nodes))
                {
                    $this->checked_nodes[] = (int)$node;
                    $this->indirect_connection($node);
                }

                //check if the nodes connected

            }
            else
            {
                for($k =0 ; $k<$n_count; $k++)
                {
                    $node_check = $curr_node_list[$k];
                    if(in_array((int)$node_check,$this->checked_nodes))
                    {
                        if(!in_array((int)$node_check, $this->checked_nodes))
                        $this->checked_nodes[] = (int)$node;
                        break;
                    }
                    else{

                            $this->connected_through_others($node);
                    }

                }
            }



        }
    }

    private function get_node_line($pos)
    {
        return $this->data[$pos];
    }
    protected function indirect_connection($node) //check if connected indirect
    {
        //get the node list

        $node_list = $this->get_node_line((int)$node);
        $count_l = count($node_list);

        for($i = 0; $i<$count_l;$i++)
        {
            $in_node = $node_list[$i];
            $in_node_list = $this->get_node_line((int)$in_node);
            if(in_array((int)$node,$in_node_list))
            {
                if(!in_array((int)$in_node,$this->checked_nodes))
                {
                    $this->checked_nodes[] = (int)$in_node;
                }
            }
        }

    }
    protected function connected_through_others($node) //check if connected through other nodes
    {
        $get_node_values = $this->get_node_line((int)$node);
        $node_count = count($get_node_values);

        for($p =0; $p<$node_count;$p++)
        {
            $c_node = $get_node_values[$p];
            if(in_array(0,$get_node_values))
            {
                if(!in_array((int)$node,$this->checked_nodes))
                $this->checked_nodes[] = (int)$node;
                break;
            }
            else
            {
                if(in_array((int)$c_node,$this->checked_nodes))
                {
                    $this->checked_nodes[] = $node;
                }
                else
                {
                    $line_node = $this->get_node_line((int)$c_node);
                    $c_count = count($line_node);

                    for($j = 0; $j < $c_count; $j++)
                    {
                        $nn = $line_node[$j];
                        if(in_array((int)$nn, $this->checked_nodes))
                        {
                            //check if nodes don't exists on the check  nodes before adding them
                            if(!in_array((int)$c_node,$this->checked_nodes) && !in_array((int)$node,$this->checked_nodes) )
                            {
                                $this->checked_nodes[] = (int)$node;
                                $this->checked_nodes[] = (int)$c_node;
                            }
                        }
                    }


                }
            }
        }

    }

}