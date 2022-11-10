<?php


class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $noticias = Noticia::find();
        $this->view->noticias = $noticias;
        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $categorias = Categoria::find();
        $this->view->categorias = $categorias;
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        $noticia = Noticia::findFirst($id);
        $categorias = Categoria::find();
        $noticia_categorias = NoticiaCategoria::find("id_noticia=" . $id);

        $categorias_noticia = [];

        foreach ($noticia_categorias as $noticia_categoria) {
            $categorias_noticia[] = $noticia_categoria->getId_categoria();
        }

        $this->view->noticia = $noticia;
        $this->view->categorias = $categorias;
        $this->view->categorias_noticia = $categorias_noticia;
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        $id = $this->request->getPost('id');

        $categorias = $this->request->getPost('categoria');

        $data = new DateTime();

        if($id){
            $noticia = Noticia::findFirst($id);
            $verbo = "editar";
            $acao = "editada";
        }
        else{
            $noticia = new Noticia();
            $noticia->setData_cadastro($data->format('Y-m-d H:i:s'));
            $verbo = "cadastrar";
            $acao = "cadastrada";
        }

        $noticia->setTitulo($this->request->getPost('titulo'));
        $noticia->setTexto($this->request->getPost('texto'));
        $noticia->setData_ultima_atualizacao($data->format('Y-m-d H:i:s'));

        $publicado = $this->request->getPost('publicado');
        $noticia->setPublicado($publicado);

        if($publicado == 1){
            $noticia->setData_publicacao($this->request->getPost('data_publicacao'));
        }

        if(!$noticia->getTitulo()){
            $this->flash->error('O título é obrigatório');
            return $this->response->redirect(array('for' => 'noticia.' . $verbo, 'id' => $id));
        }
        if(strlen($noticia->getTitulo()) > 255){
            $this->flash->error('O título deve ter até 255 caracteres');
            return $this->response->redirect(array('for' => 'noticia.' . $verbo, 'id' => $id));
        }
        
        $sucesso = $noticia->save();

        if($sucesso){
            $noticia_categorias = NoticiaCategoria::find("id_noticia=" . $noticia->getId());
            $noticia_categorias->delete();

            foreach($categorias as $categoria){
                $noticia_categoria = new NoticiaCategoria();
                $noticia_categoria->setId_noticia($noticia->getId());
                $noticia_categoria->setId_categoria($categoria);
                $noticia_categoria->save();
            }
            $this->flash->success('Notícia ' . $acao . ' com sucesso!');
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }
        else{
            $this->flash->error('Falha ao ' . $verbo . ' a notícia');
            return $this->response->redirect(array('for' => 'noticia..' . $verbo, 'id' => $id));
        }
    }

     public function excluirAction($id)
     {
        $noticia = Noticia::findFirst($id);

        $noticia_categorias = NoticiaCategoria::find("id_noticia=" . $noticia->getId());
        $noticia_categorias->delete();

        $sucesso = $noticia->delete();

        if($sucesso){
            $this->flash->success('Notícia excluída com sucesso!');
        }
        else{
            $this->flash->error('Falha ao excluir a notícia');
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}