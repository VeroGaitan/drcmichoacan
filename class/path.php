<?php

/**
 * Description of path
 *
 * @author hackde
 */
include_once 'mysqli.class.php';

class path extends conexionmysqli {

    private $_path;
    private $_resultados = array();
    private $extFiles;
    private $_location = "\\10.24.163.171\digitalizacion";
    private $_user = "digitalizacion";
    private $_pass = "Digitaliza2015";
    private $_letter = "Z";

    public function __construct($path) {
        parent::__construct("server151");
        system("net use " . $this->_letter . ": \"" . $this->_location . "\" " . $this->_pass . " /user:" . $this->_user . " /persistent:no>nul 2>&1");
        $this->_path = $this->_letter . ":/" . $path;
    }

    public function directoryList($op = null, $ext = "*") {
//1 = directorios
//2 = archivos
//3 = ambos
        $this->extFiles = explode(",", $ext);
        if (isset($op)) {
            if (!file_exists($this->_path)) {
                mkdir($this->_path, "0777", true);
            }
            if (opendir($this->_path)) {
                $dh = opendir($this->_path);
                while (($file = readdir($dh)) !== false) {
                    if (is_file($this->_path . $file) && $op == 2) {
                        if ($ext != "*") {
                            $_ext = explode(".", $file);
                            foreach ($this->extFiles as $value) {
                                if (end($_ext) == $value) {
                                    $this->_resultados[] = $this->_path . $file;
                                }
                            }
                        } else {
                            $this->_resultados[] = $file;
                        }
                    }
                    if (is_dir($file) && $file != "." && $file != ".." && $op == 1) {
                        $this->_resultados[] = $file;
                    }
                    if ($file != "." && $file != ".." && $op == 3) {
                        if (is_file($this->_path . $file)) {
                            $file = "----->" . $file;
                        } else {
                            
                        }

                        $this->_resultados[] = $file;
                    }
                }
                closedir($dh);
            }
            return $this->_resultados;
        } else {
            echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>No se ha especificado la opcion para listar, contacte al departamento de sistemas.</div>';
        }
    }

    public function directory() {
        return $this->_path;
    }

    public function extFile() {
        $extFiles = NULL;
        foreach ($this->extFiles as $value) {
            $extFiles .= $value . ",";
        }
        echo substr($extFiles, 0, -1);
    }

    public function backupDir() {
        if (!file_exists($this->_path . "/backup")) {
            mkdir($this->_path . "/backup");
            foreach ($this->_resultados as $file) {
                if (is_file($file)) {
                    $f = explode("/", $file);
                    copy($this->_path . end($f), $this->_path . "backup/" . end($f));
                }
            }
//            
//            
        }
    }

    public function renameFile($fileName, $book, $ID_USUARIO) {
        $names = explode("&", $fileName); //$f guarda la separacion entre -, nombreactual [posicion 0] - nuevonombre&fechaimagen [posicion 1]
        $oldName = array_shift($names);
        $newName = array_pop($names);
        $newName_ = explode("/", $newName);
        $fechaImg = date("Y-m-d H:i:s", filectime($oldName));
        //rename($oldName, $newName)
        if (rename($oldName, $newName)) {
            $this->detalleBitacora(array_pop($newName_), $book, $ID_USUARIO, $fechaImg);
            echo json_encode(array("success" => "true"));
        } else {
            echo json_encode(array("success" => "false"));
        }
    }

    private function detalleBitacora($newName, $book, $ID_USUARIO, $fechaImg) {//uno en uno
        if (strlen($newName) > 26) {
            $actaBis = substr($newName, -5, 1);
        } else {
            $actaBis = 0;
        }
        $ACTA = substr($newName, 17, 5);
//entre $ACTA y $ruta, falta validar si es acta bis, se pone provicionalmente un 0
        $sql = "CALL digitalizacion_acta(" . $book["ID_LIBRO"] . "," . $book["ACTO"] . ",16," . $book["MUNICIPIO"] . "," . $book["OFICIALIA"] . "," . $book["ANO"] . "," . $book["TOMO"] . "," . $book["TBIS"] . ",{$ACTA},'{$actaBis}','{$newName}','{$fechaImg}','PM15',{$ID_USUARIO},CURDATE(),'','PM15',{$ID_USUARIO},CURDATE(),'')";
        $this->query($sql);
    }

    public function bitacora($ID_LIBRO, $NO_IMAGENES_SALIDA, $NO_IMAGENES_DIGITALIZADAS, $ACTA_INICIAL_DIGITALIZA, $ACTA_FINAL_DIGITALIZA, $ID_USUARIO, $NO_IMAGENES_INDEXADAS) {//se ejecuta al final
        $sql = "CALL digitalizacion_termina({$ID_LIBRO}, 0, {$NO_IMAGENES_SALIDA}, {$NO_IMAGENES_DIGITALIZADAS}, {$ACTA_INICIAL_DIGITALIZA}, {$ACTA_FINAL_DIGITALIZA}, {$ID_USUARIO}, CURDATE(), {$ID_USUARIO}, CURDATE(), {$NO_IMAGENES_INDEXADAS}, '')";
        if ($this->query($sql)) {
            echo json_encode(array("bitacora" => "true"));
        }else{
            echo json_encode(array("bitacora" => "false"));
        }
    }

}

/* * ********************** MAIN ****************************** */

function createExplorer($path) {
    $explorer = new path($path);
    return $explorer;
}

if (filter_input(INPUT_POST, "func") == "rename") {
    $book = json_decode(filter_input(INPUT_POST, "book"), true);
    $explorer = createExplorer(filter_input(INPUT_POST, "path"));
    $explorer->renameFile(filter_input(INPUT_POST, "fileName"), $book, filter_input(INPUT_POST, "ID_USUARIO"));
}
if (filter_input(INPUT_POST, "func") == "bitacora") {
    $book = json_decode(filter_input(INPUT_POST, "book"), true);
    $explorer = createExplorer(filter_input(INPUT_POST, "path"));
    $ID_LIBRO = filter_input(INPUT_POST, "ID_LIBRO");
    $NO_IMAGENES_SALIDA = filter_input(INPUT_POST, "NO_IMAGENES_SALIDA");
    $NO_IMAGENES_DIGITALIZADAS = filter_input(INPUT_POST, "NO_IMAGENES_DIGITALIZADAS");
    $ACTA_INICIAL_DIGITALIZA = filter_input(INPUT_POST, "ACTA_INICIAL_DIGITALIZA");
    $ACTA_FINAL_DIGITALIZA = filter_input(INPUT_POST, "ACTA_FINAL_DIGITALIZA");
    $ID_USUARIO = filter_input(INPUT_POST, "ID_USUARIO");
    $NO_IMAGENES_INDEXADAS = filter_input(INPUT_POST, "NO_IMAGENES_INDEXADAS");
    $explorer->bitacora($ID_LIBRO, $NO_IMAGENES_SALIDA, $NO_IMAGENES_DIGITALIZADAS, $ACTA_INICIAL_DIGITALIZA, $ACTA_FINAL_DIGITALIZA, $ID_USUARIO, $NO_IMAGENES_INDEXADAS);
}