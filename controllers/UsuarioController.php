<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idTipoUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O idTipoUsuario, BLZ');
            if (empty($dados['nomeUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O nomeUsuario, BLZ');
            if(empty($dados['emailUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O emailUsuario, BLZ');
            if (empty($dados['senhaUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O senhaUsuario, BLZ');

            $usuario = new UsuarioModel(
                null,
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUusario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O idUsuario, BLZ');
            if(empty($dados['idTipoUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O idTipoUsuario, BLZ');
            if (empty($dados['nomeUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O nomeUsuario, BLZ');
            if(empty($dados['emailUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O emailUsuario, BLZ');
            if (empty($dados['senhaUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O senhaUsuario, BLZ');

            $usuario = new UsuarioModel(
                $dados['idUsuario'],
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if(empty($dados['idUsuario']))
                return $this->mostrarErro('BRUXO, INFORMA O idUsuario, BLZ');

            $usuario = new UsuarioModel(
                $dados['idUsuario'],
            );

            $usuario->delete();

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