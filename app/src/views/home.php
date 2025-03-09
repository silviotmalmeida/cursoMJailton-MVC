<h2>Aqui fica a view <?php

use src\core\Messages;

 echo($view);?></h2>
<h2>Mensagem: <?php print_r(Messages::getMsg());?></h2>
<h2>Array de dados: <?php print_r($viewData);?></h2>
