<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ (isset($pagAtual) && $pagAtual == 'home') ? 'active' : '' }}">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item {{ (isset($pagAtual) && $pagAtual == 'categorias') ? 'active' : '' }}">
        <a class="nav-link" href="/categorias">Categorias</a>
      </li>
      <li class="nav-item {{ (isset($pagAtual) && $pagAtual == 'produtos') ? 'active' : '' }}">
        <a class="nav-link" href="/produtos">Produtos</a>
      </li>
      <li class="nav-item {{ (isset($pagAtual) && $pagAtual == 'clientes') ? 'active' : '' }}">
        <a class="nav-link" href="/clientes">Clientes</a>
      </li>
    </ul>
  </div>
</nav>
