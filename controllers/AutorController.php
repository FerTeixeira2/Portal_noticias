<?php
    require_once './models/AutorModel.php';

    class AutorController {
        public function getAutores() {
            $autorModel = new AutorModel();

            $response = $autorModel->getAutores();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createAutor() {
            $dados = json_decode(file_get_contents('php://input'), true);
            if (empty($dados['nomeAutor'])) {
                return $this->mostrarErro('BRUXO, INFORMA O nomeAutor, BLZ!');
            }

            $autor = new AutorModel(
                null, 
                $dados['nomeAutor'],

            );

            $response =  $autor->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);   
        }
 
        public function updateAutor() {
            $dados = json_decode(file_get_contents('php://input'), true);
            if (empty($dados['idAutor'])) {
                return $this->mostrarErro('BRUXO, INFORMA O idAutor, BLZ!');
            }
            if (empty($dados['nomeAutor'])) {
                return $this->mostrarErro('BRUXO, INFORME O nomeAutor, BLZ!');
            }

            $autor = new AutorModel(
                $dados['idAutor'],
                $dados['nomeAutor']
            );

            $response = $autor->update();        

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteAutor(){
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idAutor']))
                return $this->mostrarErro('BRUXO, INFORMA O idAutor, BLZ');

            $autor = new AutorModel(
                $dados['idAutor'],
            );

            $autor->delete();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]); 
        }
    }
?>