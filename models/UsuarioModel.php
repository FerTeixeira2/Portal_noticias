<?php
    require_once 'DAL/UsuarioDAO.php';

    class UsuarioModel {
        public ?int $idUsuario;
        public ?int $idTipoUsuario;
        public ?string $nomeUsuario;
        public ?string $emailUsuario;
        public ?string $senhaUsuario;

        public function __construct(
            ?int $idUsuario = null,
            ?int $idTipoUsuario = null,
            ?string $nomeUsuario = null,
            ?string $emailUsuario = null,
            ?string $senhaUsuario = null
        )
        {
            $this->idUsuario = $idUsuario;
            $this->idTipoUsuario = $idTipoUsuario;
            $this->nomeUsuario = $nomeUsuario;
            $this->emailUsuario = $emailUsuario;
            $this->senhaUsuario = $senhaUsuario;
        }

        public function getUsuarios() {
            $usuarioDAO = new UsuarioDAO();

            $usuarios = $usuarioDAO->getUsuarios();

            foreach ($usuarios as &$usuario) {
                $usuario = new UsuarioModel(
                    $usuario['idUsuario'],
                    $usuario['idTipoUsuario'],
                    $usuario['nomeUsuario'],
                    $usuario['emailUsuario'],
                    $usuario['senhaUsuario']
                );
            }

            return $usuarios;
        }

        public function create() {
            
        }

        public function update() {
            
        }

        public function delete() {
            
        }
    }
?>