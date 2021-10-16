<?php
namespace App\Service;


class Checker
{
  

    public function __construct()
    {
       
    }

  
    public function checkPalindrome($parameter):bool
        {
            $word_len = strlen($parameter);
            $mid_number = (int) ceil($word_len / 2) - 1;
            $selected_number = array();
            for ($i = 0; $i < $word_len; $i++) {
                $current_number = $parameter[$i];
                $selected_number[] = $current_number;
                $compare = $word_len - ($i + 1);
                
                if ($i > $mid_number && $current_number != $selected_number[$compare]) {
                    return false;
                }
            }
            return true;
        }

public function checkAnagram($parameter): bool
{
    $given_word=explode(",",$parameter);
    if(count($given_word)==2){
        $first_part=$given_word[0];
        $second_part=$given_word[1];
        $split_part1=str_split($first_part);
        $split_part2=str_split($second_part);
        $cnt=0;
        foreach ($split_part1 as $k => $v) {
            if (!in_array($v, $split_part2)) {
                $cnt++;
            }
        }
        if ($cnt != 0) {
            return false;
        } else {
            return true;
        }
    }else{
        return false;
    }
}


    public function checkPangram($parametter):bool
    {
    $alphabets = "a,b,c,d,e,f,g,h,i,j,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
    $array_alphabets = explode(",", $alphabets);
    $array_sentence = str_split($parametter);
        $cnt = 0;
        for ($i = 0; $i < count($array_alphabets); $i++) {
            for ($j = 0; $j < sizeof($array_sentence); $j++) {
                if ($array_alphabets[$i] == $array_sentence[$j]) {
                    $cnt++;
                    break;
                }
            }
        }
        if ($cnt == count($array_alphabets)) {
            return true;
        } else {
            return false;
        }
    }
}
?>