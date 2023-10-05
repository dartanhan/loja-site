function postLink(url, categoria_id, produto_id) {
    let form = document.createElement('form');
    form.action = url;
    form.method = 'POST';


    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let inputCategoriaId = document.createElement('input');
    inputCategoriaId.type = 'hidden';
    inputCategoriaId.name = 'categoria_id';
    inputCategoriaId.value = categoria_id;

    let inputProdutoId = document.createElement('input');
    inputProdutoId.type = 'hidden';
    inputProdutoId.name = 'produto_id';
    inputProdutoId.value = produto_id;

    let inputToken = document.createElement('input');
    inputToken.type = 'hidden';
    inputToken.name = '_token';
    inputToken.value = csrfToken;

    form.appendChild(inputCategoriaId);
    form.appendChild(inputProdutoId);
    form.appendChild(inputToken);

    document.body.appendChild(form);

    form.submit();
}
