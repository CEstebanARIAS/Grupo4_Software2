<?php

require_once "Models/PutModel.php";

class PutController {
    /* Petición para actualizar datos */
    static public function putData($table, $data, $id, $nameId) {
        $response = PutModel::putData($table, $data, $id, $nameId);
        $return = new PutController();
        $return ->fncResponse($response);
    }

    /* Petición para actualizar datos de un usuario */
    static public function putUser($table, $data, $id, $suffix) {
        if (isset($data["password_".$suffix]) && ($data["password_".$suffix] != null)) {
            $crypt = crypt($data["password_".$suffix], ' ');
            $data["password_".$suffix] = $crypt;
        }
        $response = PutModel::putData($table, $data, $id, "id_".$suffix);
        $return = new PutController();
        $return ->fncResponse($response);
    }

    /* Petición para actualizar datos con condiciones específicas */
    static public function putConditionalData($table, $data, $conditions) {
        $response = PutModel::putConditionalData($table, $data, $conditions);

        $return = new PutController();
        $return ->fncResponse($response);
    }

    public function fncResponse($response) {
        if (!empty($response)) {
            $json = array(
                'status' => 200,
                'result' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'result' => 'No se pudo actualizar los datos'
            );
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
}
?>
