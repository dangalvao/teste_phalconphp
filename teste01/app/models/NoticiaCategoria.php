<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class NoticiaCategoria extends Model
{

	private $id;
    private $id_noticia;
    private $id_categoria;   

    public function initialize()
    {
        $this->setSource("noticia_categoria");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId_noticia()
    {
        return $this->id_noticia;
    }

    public function setId_noticia($id_noticia)
    {
        $this->id_noticia = $id_noticia;
    }

     public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
}