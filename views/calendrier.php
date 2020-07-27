
<nav>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                            <li class="menu-text">
                            <li><a href="index.php?route=membre">Accueil</a></li>
                            <li><a href="index.php?route=cours">Mes cours</a></li>
                            <li><a href="index.php?route=calendrier">Agenda</a></li>
                            <li><a href="index.php?route=user">Mon profil</a></li>
                            <?php 
                        if ($_SESSION['role'] == 'Enfant'){
                        require "html/menueleve.html";

                        } else if($_SESSION['role'] == 'Professeur'){
                        require "html/menuprof.html";
                        
                        } else {
                        require "html/menuparent.html";
                        }
                        ?>
                        <li><a href="index.php?route=deconnect">Me deconnecter</a></li>
                    </ul>
                </div>
            </div>
    </nav>

<h1 class="text-center">Mon planning</h1>

<h2 class="text-center">Mois de <?= $month->getMonthName() ?> <?= $month->getYear() ?></h2>

<div class="nav-arrow">
    <div class="left-arrow">
    <div><a href="index_month.php?month=<?=$month->getPrevious()->format("m") ?>&year=<?= $month->getPrevious()->format("Y") ?>"></a></div>
    </div>
    <div class="right-arrow">
    <div><a href="index_month.php?month=<?=$month->getNext()->format("m") ?>&year=<?= $month->getNext()->format("Y") ?>"></a></div>
    </div>
</div>

<table class="table-calendrier">
    <?php for($i = 0; $i < $month->getNbWeeks(); $i++): ?>
        <tr>
            <?php foreach(Month::DAY_NAME_FR as $k => $day): ?>
                <td>
                    <?php $class = ($month->getFirstMonday()->modify("+ ".($k + $i*7)." day")->format('m') === $month->getFirst()->format('m'))? "current" : "out";
                    ?>
                    <span class="<?= $class ?>-day"><?= $day ?></span><br>
                    <span class=<?= $class ?>><?= $month->getFirstMonday()->modify("+ ".($k + $i*7)." day")->format('d') ?></span>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endfor; ?>
</table>













