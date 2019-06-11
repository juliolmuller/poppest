
// Monta a linha em HTML de um registro de produto
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

// Captura a lista de produtos
function carregarProdutos() {
  $.getJSON('/api/produtos', function(resp) {
    for (var i = 0; i < resp.length; i++) {
      $('#tabela-produtos>tbody').append(montarLinha(resp[i]))
    }
  })
}

// Captura a lista de categorias para adicionar ao combobox
function carregarCategorias() {
  $.getJSON('/api/categorias', function(resp) {
    for (var i = 0; i < resp.length; i++) {
      $('#form-produtos-categoria').append(`<option value="${resp[i].id}">${resp[i].nome}</option>`)
    }
  })
}

// Exibe o formulário para criação/edição de produto
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

// Carrega os valores dos campos do formulário
function carregarCampos(produto) {
  $('#form-produtos-id').val(produto ? produto.id : ''),
  $('#form-produtos-nome').val(produto ? produto.nome : ''),
  $('#form-produtos-estoque').val(produto ? produto.estoque : ''),
  $('#form-produtos-preco').val(produto ? produto.preco : ''),
  $('#form-produtos-categoria').val(produto ? produto.categoria.id : '')
}

// Enviar formulário para criaão de produto
function criarProduto(produto) {
  $.post('/api/produtos', produto, function(resp) {
    $('#tabela-produtos>tbody').append(montarLinha(resp))
  })
}

// Requisitar exclusão de registro de produto
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

// Carregar formulário para edição de produto
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

// Configura evento de submissão para o formulário
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
