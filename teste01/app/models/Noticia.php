<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{

	private $id;
    private $titulo;
    private $texto;
    private $data_ultima_atualizacao;
    private $data_cadastro;
    private $publicado;
    private $data_publicacao;

    public function initialize()
    {
        $this->setSource("noticia");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }
    
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getData_ultima_atualizacao()
    {
        return $this->data_ultima_atualizacao;
    }
    
    public function setData_ultima_atualizacao($data_ultima_atualizacao)
    {
        $this->data_ultima_atualizacao = $data_ultima_atualizacao;
    }
    
    public function getData_cadastro()
    {
        return $this->data_cadastro;
    }
    
    public function setData_cadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    public function getPublicado()
    {
        return $this->publicado;
    }
    
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;
    }

    public function getData_publicacao()
    {
        return $this->data_publicacao;
    }
    
    public function setData_publicacao($data_publicacao)
    {
        $this->data_publicacao = $data_publicacao;
    }
    
}