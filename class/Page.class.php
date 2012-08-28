<?php
/**
 *	Page class
 *
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 200906717
*/
class Page 
{
    /**
     *  escape html tags 
     *
     *  @param  string or N-array
     *  @return string or N-array
     */
    static function escapeHtml($text)
    {
        if (is_array($text))
        {
            foreach ($text as $key => $value)
            {
                $text[$key] = Page::escapeHtml($value);
            }
        }
        else 
        {
            $text = htmlspecialchars($text, ENT_QUOTES);
        }
        return $text;
    }
       
    /**
     *  get pager array
     *
     *  @param  int
     *  @param  int
     *  @param  int
     *  @param  int
     *  @return array
     */
    static function pager($nums, $current, $limit)
    {
        // init
        $pager = array(
            'all'       => 0, 
            'from'      => 0, 
            'to'        => 0, 
            'pages'     => array(), 
            'prev_page' => 0, 
            'next_page' => 0
        );
        
        // offset
        $offset = ($current * $limit) - $limit;
        // all nums
        $pager['all'] = $nums;
        // from
        $pager['from'] = $offset + 1;
        // to
        $pager['to'] = (($offset + $limit) > $pager['all']) ? $pager['all'] : $offset + $limit;
        // pages array
        $cnt = ceil($nums / $limit);
        for($i =1; $i <= $cnt; $i++)
        {
            $pager['pages'][] = $i;
        }
        // prev
        $pager['prev_page'] = $current - 1;
        // next
        $pager['next_page'] = $current + 1;
        
		// current
        $pager['curr_page'] = $current;
		//when current is only one,  current=current-1;
        //this is for delete...		
       /* if (($pager['all'] - (($current - 1) * $limit)) == 1)
        {
        	$pager['curr_page'] = $pager['curr_page'] - 1;
        }  */ 
        $pager['from'] = $pager['from'] > $pager['to'] ?    $pager['to'] : $pager['from'];
        return $pager;
    } 
	
	/**
     *  get fold flag
     *
     *  @param  
     *  @return int
     */
    /*static function foldFlag()
    {
    	$flag = 1;
        $dirArr = split('/', dirname($_SERVER['SCRIPT_FILENAME']));
        $foldName = $dirArr[count($dirArr)-1];
        switch ($foldName)
        {
            case 'foto-ss':
                $flag = 1;
                break;
            case 'album':
                $flag = 2;
                break;
            case 'upload':
                $flag = 3;
                break;
            case 'account':
                $flag = 4;
                break;
        }
        return $flag;
    }*/
}

?>
