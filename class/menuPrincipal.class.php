<?php

/**
 * Description of menuPrincipal
 *
 * @author hackde
 */
include_once './mysqli.class.php';

class menuPrincipal extends conexionmysqli {

    private $ID_USUARIO;

    function __construct($ID_USUARIO) {
        parent::__construct("server151");
        $this->ID_USUARIO = $ID_USUARIO;
    }

    private function getMenuQuery() {
        $sql = "SELECT NOMBRE_ROL, ETIQUETA, LINK FROM view_usuarios_sistema U left join  view_rol_permisos P on u.ID_ROL=P.ID_ROL WHERE ID_USUARIO = '" . $this->ID_USUARIO . "'";
        $menuQuery = $this->query($sql);
        $_menuQuery = $menuQuery->fetch_all();
        //print_r("<pre>");
        //print_r($_menuQuery);
        //print_r("</pre>");
        $this->close();
        return $_menuQuery;
    }

    public function buildMenu() {
        $oldTitle = NULL;
        $menu = NULL;


        foreach ($this->getMenuQuery() as $label) {

//            echo "<pre>";
//            var_dump($label);
//            echo "</pre>";


            if ($label[0] != $oldTitle) {
                $menu .= '</ul></li>';
                $menu .= '<li class="dropdown">';
                $menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'
                        . '<span class="glyphicon glyphicon-ok-circle"></span> '
                        . '<b>' . strtoupper($label[0]) . '</b><b class="caret"></b>'
                        . '</a>'
                        . '<ul class="dropdown-menu">';
            }
            if($label[2]=="#"){
                 $disabled = "class=\"disabled\"";
            }else{
                $disabled = "";
            }
            $menu .='<li '.$disabled.'>'
                    . '<a onclick="$(this).contentLoaded(\''.$label[2].'\',\''.$label[1].'\');" href="#">'
                    . '<span class="glyphicon glyphicon-chevron-right"></span> ' . strtoupper($label[1]) . ''
                    . '</a>'
                    . '</li>';
            $oldTitle = $label[0];
        }
        echo substr($menu.'</ul></li>',10);
    }

}

$myMenu = new menuPrincipal(filter_input(INPUT_GET, "ID_USUARIO"));
$myMenu->buildMenu();

