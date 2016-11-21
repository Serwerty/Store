<?php
function selectPage($page,$maxPage)
{
    $actual_link = "http://localhost/Store/index.php";
    
    echo '<div class = "page_selector">';
    echo '<div class = "page_selector_left">';
    if ($page != 1)
    {
        echo '<a href="'.$actual_link.'?page='.($page-1).'"><img border="0" src="images/prev.png" width="16" height="16"/></a>';    
        echo '<a href="'.$actual_link.'?page=1">    First</a>';    
    }
    echo '</div>';
    echo '<div class = "page_selector_center">';
        echo 'page '.$page.' of '.$maxPage.'';
    echo '</div>';
    echo '<div class = "page_selector_right">';
    if ($page != $maxPage)
    {
        echo "<a href=\"".$actual_link."?page=".$maxPage."\">Last  </a>";    
        echo '<a href="'.$actual_link.'?page='.($page+1).'"><img border="0" src="images/next.png" width="16" height="16"/></a>';   
    }
    echo '</div>';  
    echo '</div>';    
}
?>