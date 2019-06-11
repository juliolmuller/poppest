
<div id="modal-produtos" class="modal" tabindex="1" role="dialog">
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
              <input id="form-produtos-nome" class="form-control" type="text" name="nome" value="" />
            </div>
          </div>
          <div class="form-group">
            <label for="form-produtos-estoque">Estoque:</label>
            <div class="input-group">
              <input id="form-produtos-estoque" class="form-control" type="number" name="estoque" value="" />
            </div>
          </div>
          <div class="form-group">
            <label for="form-produtos-preco">Preço:</label>
            <div class="input-group">
              <input id="form-produtos-preco" class="form-control" type="number" name="preco" value="" />
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
</div>
