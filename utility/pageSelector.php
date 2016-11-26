<?php
function selectPage($page,$maxPage)
{
    $actual_link = "https://jus-sante.herokuapp.com/index.php";
    
    echo '<div class = "page_selector">';
    echo '<div class = "page_selector_left">';
    if ($page != 1)
    {
        echo '<a href="'.$actual_link.'?page='.($page-1).'"><img border="0" src="images/Previous-Button.png" width="48" height="56"/></a>';    
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
        echo '<a href="'.$actual_link.'?page='.($page+1).'"><img border="0" src="images/Next-Button.png" width="48" height="56"/></a>';   
    }
    echo '</div>';  
    echo '</div>';    
}
?>