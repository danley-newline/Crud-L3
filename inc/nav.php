<nav id="nav">
    <ul>
        <li>
            <a <?php if ($page == "home") {
                    echo 'class="active"';
                    } else {
                        echo "";
                    } 
            ?> href="index.php" >
            Info-Etudiant
            </a>
                </li>
       
        <li><a <?php echo ($page == 'news' )? "class='active'" : "" ?>  href="news.php">Moyenne-Annuelle</a></li>
        </ul>
</nav>


<?php


