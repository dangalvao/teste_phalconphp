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
        
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        $noticia = Noticia::findFirst($id);
        $this->view->noticia = $noticia;
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        $id = $this->request->getPost('id');

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