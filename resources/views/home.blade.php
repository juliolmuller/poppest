@extends('layout.app')

@section('body')

  <!-- Page header -->
  <header id="page-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="intro-text">
            <span class="name">POPPEST</span>
            <hr class="star-light">
            <p class="skills">The Most Popular Repositories in GitHub</p>
          </div>
        </div>
      </div>
    </div>
  </header>
  <main class="content-wrapper">
    <div class="container">
      <h2 class="content-header">Pick your favorite language:</h2>
      <nav class="nav nav-pills nav-fill">
          <a class="nav-item nav-link active" href="#">Active</a>
        @foreach ($repoByLang as $language)
          <a class="nav-item nav-link" href="#">{{ $language->name }}</a>
        @endforeach
        <a class="nav-item nav-link disabled" href="#">Disabled</a>
      </nav>
    </div>
  </main>



  <!-- Listagem de Prdoutos -->
  <!--<div id="modal-produtos" class="modal" tabindex="1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="form-produtos" class="form-horizontal">
          <div class="modal-header">
            <h3 id="form-produtos-titulo" class="modal-title">Novo Produto</h3>
          </div>
          <div class="modal-body">
            <input id="form-produtos-id" type="hidden" class="form-control" value="" />
            <div class="form-group">
              <label for="form-produtos-nome">Nome:</label>
              <div class="input-group">
                <input id="form-produtos-nome" class="form-control" type="text" name="nome" value="{{ $produto->nome ?? '' }}" />
              </div>
            </div>
            <div class="form-group">
              <label for="form-produtos-estoque">Estoque:</label>
              <div class="input-group">
                <input id="form-produtos-estoque" class="form-control" type="number" name="estoque" value="{{ $produto->estoque ?? '' }}" />
              </div>
            </div>
            <div class="form-group">
              <label for="form-produtos-preco">Preço:</label>
              <div class="input-group">
                <input id="form-produtos-preco" class="form-control" type="number" name="preco" value="{{ $produto->preco ?? '' }}" />
              </div>
            </div>
            <div class="form-group">
              <label for="form-produtos-categoria">Categoria:</label>
              <div class="input-group">
                <select id="form-produtos-categoria" class="form-control" type="text" name="categoria">
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>-->

@endsection

@section('styles')

  <style>
    header {
      text-align: center;
      color: #fff;
      background: #18bc9c;
      position: fixed;
      width:100%;
      z-index: 1;
      height: 30%;
      overflow: hidden;
      top: 0;
      left: 0;
    }
    .content-wrapper {
      background-color: white;
      top: 32%;
      min-height: 12%;
      position:absolute;
      z-index: 2;
      width: 100%;
    }
    .content-header {
      margin-bottom: 20px;
    }
    header .container {
      padding-top: 20px;
      padding-bottom: 50px;
    }
    header .intro-text .name {
      display: block;
      text-transform: uppercase;
      font-family: 'Indie Flower', cursive;
      font-size: 3em;
      font-weight: 700;
    }
    header .intro-text .skills {
      font-size: 1.25em;
      font-weight: 300;
    }
    section {
      padding: 100px 0;
      width: 100%;
    }
    section h2 {
      margin: 0;
      font-size: 3em;
    }
    hr.star-light, hr.star-primary {
      margin: 25px auto 30px;
      padding: 0;
      max-width: 250px;
      border: 0;
      border-top: solid 5px;
      text-align: center;
    }
    hr.star-light:after, hr.star-primary:after {
      content: "\f005";
      display: inline-block;
      position: relative;
      top: -.8em;
      padding: 0 .25em;
      font-family: FontAwesome;
      font-size: 2em;
    }
    hr.star-light {
      border-color: #fff;
    }
    hr.star-light:after {
      color: #fff;
      background-color: #18bc9c;
    }
    hr.star-primary {
      border-color: #2c3e50;
    }
    hr.star-primary:after {
      color: #2c3e50;
      background-color: #fff;
    }
    section.primary h2{
      color: #2c3e50;
    }
    section.success{
      background-color: #18bc9c;
      color: #fff;
    }
  </style>

@endsection

@section('scripts')

  <script></script>

@endsection

@section('scripts2')

  <script type="text/javascript">

    {{-- Adiciona o token ao cabeçalho das requisições AJAX --}}
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })

    {{-- Monta a linha em HTML de um registro de produto  --}}
    function montarLinha(produto) {
      return `
        <tr id="produto-${produto.id}">
          <td>${produto.id}</td>
          <td>${produto.nome}</td>
          <td>${produto.estoque}</td>
          <td>$ ${parseFloat(produto.preco).toFixed(2)}</td>
          <td>${produto.categoria.nome}</td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="carregarForm(${produto.id})">Editar</button>
            <button class="btn btn-sm btn-danger" onclick="excluirProduto(${produto.id})">Excluir</button>
          </td>
        </tr>
      `
    }

    {{-- Captura a lista de produtos --}}
    function carregarProdutos() {
      $.getJSON('/api/produtos', function(resp) {
        for (var i = 0; i < resp.length; i++) {
          $('#tabela-produtos>tbody').append(montarLinha(resp[i]))
        }
      })
    }

    {{-- Captura a lista de categorias para adicionar ao combobox --}}
    function carregarCategorias() {
      $.getJSON('/api/categorias', function(resp) {
        for (var i = 0; i < resp.length; i++) {
          $('#form-produtos-categoria').append(`<option value="${resp[i].id}">${resp[i].nome}</option>`)
        }
      })
    }

    {{-- Exibe o formulário para criação/edição de produto --}}
    function carregarForm(id) {
      $('#form-produtos-titulo').html(id ? `Produto ${id}` : 'Novo Produto')
      if (id)
        $.getJSON(`/api/produtos/${id}`, function(resp) {
          carregarCampos(resp)
        })
      else
        carregarCampos()
      $('#modal-produtos').modal('show')
    }

    {{-- Carrega os valores dos campos do formulário --}}
    function carregarCampos(produto) {
      $('#form-produtos-id').val(produto ? produto.id : ''),
      $('#form-produtos-nome').val(produto ? produto.nome : ''),
      $('#form-produtos-estoque').val(produto ? produto.estoque : ''),
      $('#form-produtos-preco').val(produto ? produto.preco : ''),
      $('#form-produtos-categoria').val(produto ? produto.categoria.id : '')
    }

    {{-- Enviar formulário para criaão de produto --}}
    function criarProduto(produto) {
      $.post('/api/produtos', produto, function(resp) {
        $('#tabela-produtos>tbody').append(montarLinha(resp))
      })
    }

    {{-- Requisitar exclusão de registro de produto --}}
    function excluirProduto(id) {
      if (confirm(`Tem certeza de que quer excluir o produto ${id}?`)) {
        $.ajax({
          type: 'DELETE',
          url: `/api/produtos/${id}`,
          context: this,
          success: function(resp) {
            console.log(`=> '${resp.nome}' excluído com sucesso.`)
            $(`#produto-${id}`).remove()
          },
          error: error => console.log(error)
        })
      }
    }

    {{-- Carregar formulário para edição de produto --}}
    function editarProduto(produto) {
      $.ajax({
        type: 'PUT',
        data: produto,
        url: `/api/produtos/${produto.id}`,
        context: this,
        success: function(resp) {
          $(`#produto-${resp.id}`).replaceWith(montarLinha(resp))
        },
        error: error => console.log(error)
      })
    }

    {{-- COnfigura evento de submissão para o formulário --}}
    $('#form-produtos').submit(function(event) {
      event.preventDefault()
      const produto = {
        id:        $('#form-produtos-id').val(),
        nome:      $('#form-produtos-nome').val(),
        estoque:   $('#form-produtos-estoque').val(),
        preco:     $('#form-produtos-preco').val(),
        categoria: $('#form-produtos-categoria').val()
      }
      if (produto.id)
        editarProduto(produto)
      else
        criarProduto(produto)
      $('#modal-produtos').modal('hide')
    })

    $(function() {
      carregarProdutos()
      carregarCategorias()
    })

  </script>

@endsection
