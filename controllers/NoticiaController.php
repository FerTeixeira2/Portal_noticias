<?php
    require_once __DIR__ . '/../models/NoticiaModel.php';

    class NoticiaController{
        public function getNoticias() {
            $noticiaModel = new NoticiaModel();

            $response = $noticiaModel->getNoticias();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createNoticia() {
            $dados = json_decode(file_get_contents('php://input'), true);
            if (empty($dados['idAutor'])) {
                return $this->mostrarErro('BRUXO, INFORMA O idAutor, BLZ!');
            }
            if (empty($dados['tituloNoticia'])) {
                return $this->mostrarErro('BRUXO, INFORMA O tituloNotica, BLZ!');
            }
            if (empty($dados['conteudoNoticia'])) {
                return $this->mostrarErro('BRUXO, INFORMA O conteudoNoticia, BLZ!');
            }

            $noticia = new NoticiaModel(
                null, 
                $dados['idAutor'], 
                $dados['tituloNoticia'], 
                $dados['conteudoNoticia'],
                $dados['imagemNoticia']
            );

            $response =  $noticia->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateNoticia() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idNoticia'])) {
                return $this->mostrarErro('BRUXO, INFORMA O idNoticia, BLZ');
            }
            if (empty($dados['idAutor'])) {
                return $this->mostrarErro('BRUXO, INFORMA O idAutor, BLZ!');
            }
            if (empty($dados['tituloNoticia'])) {
                return $this->mostrarErro('BRUXO, INFORMA O tituloNotica, BLZ!');
            }
            if (empty($dados['conteudoNoticia'])) {
                return $this->mostrarErro('BRUXO, INFORMA O conteudoNoticia, BLZ!');
            }

            $noticia = new noticiaModel(
                $dados['idNoticia'],
                $dados['idAutor'],
                $dados['tituloNoticia'],
                $dados['conteudoNoticia'],
                $dados['imagemNoticia']
            );

            $response = $noticia->update();        

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteNoticia() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idNoticia']))
                return $this->mostrarErro('BRUXO, INFORMA O idNoticia, BLZ');

            $noticia = new NoticiaModel(
                $dados['idNoticia']
            );

            $response = $noticia->delete();

            return json_encode([
                'error' => null,
                'result' => $response
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