{% extends 'layouts/index.volt' %}

{% block content %}

    <div id="cadastro_ticket" class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-plus"></i>
                    &nbsp;Editar Noticia
                </div>
                {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar') }}
                    
                    <div class="panel-body">
                        <div class="col-md-12"  id="conteudo">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <p><strong>Data de Criação:</strong> {{noticia.getData_cadastro()}}</p>
                                            <p><strong>Data da Última Atualização:</strong> {{noticia.getData_ultima_atualizacao()}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for ="Titulo">Título <span class="error">(*)<span></label>
                                            <input name= "titulo" type="text" value="{{noticia.getTitulo()}}" width='100%' class= "form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for ="Texto">Texto</label>
                                            <textarea name = "texto" class= "form-control">{{noticia.getTexto()}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12 categorias">
                                            <div class="col-sm-6 categorias">
                                                <label class="col-sm-4">Categorias <span class="error">(*)<span>: </label>
                                                <select name="categoria[]" id="categorias" class="selectpicker form-control col-sm-8" multiple
                                                    data-live-search="true">
                                                    {% for categoria in categorias %}
                                                    <option value="{{categoria.getId()}}"
                                                    <?php if (in_array($categoria->getId(), $categorias_noticia)) echo "selected"; ?> >{{categoria.getNome()}}</option>
                                                    {% endfor %}
                                                </select>
                                            </div>
                                            <div class="col-sm-6 categorias">
                                                <div class="col-sm-3">
                                                    <input class="form-check-input" onclick = "publicar();" type="checkbox" value="1" id="publicado" name="publicado"
                                                    <?php if ($noticia->getPublicado()) echo "checked"; ?> >
                                                    <label class="form-check-label" for="publicado">
                                                        Publicado
                                                    </label>
                                                </div>
                                                <div class="col-sm-9 data_pub_div" id="data_pub_div"
                                                style="<?php if ($noticia->getPublicado()) echo 'display: block'; ?>">
                                                    <div class="col-sm-12">
                                                        <div class="row"><label>Data da publicação: </label></div>
                                                        <div class="row">
                                                            <input type="date" name="data_publicacao" id="data_publicacao" class="form-control" maxlength="10" placeholder="dd-mm-yyyy" autocomplete="off" value="{{noticia.getData_publicacao()}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{noticia.getId()}}">
                                </div>{#/.panel-body#}
                            </div>{#/.panel#}
                            <div class="row" style="text-align:right;">
                                <div id="buttons-cadastro" class="col-md-12">
                                    <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                                    {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                                </div>
                            </div>
                        </div>{#/.conteudo#}
                    </div>{#/.panel-body#}
                {{ end_form() }}
            </div>{#/.panel#}
        </div>{#/.col-md-12#}
    </div><!-- row -->

{% endblock %}

{%  block extrafooter %}
    
    <script>
        $(document).ready(function(){
        });
        function publicar(){
            div = document.getElementById('data_pub_div').style.display;
            if(div !== "block"){
                document.getElementById('data_pub_div').style.display = "block";
            }
            else{
                document.getElementById('data_pub_div').style.display = "none";
            }
        }
    </script>
{% endblock %}
