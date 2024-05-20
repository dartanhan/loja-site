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


$(document).ready(function() {
// Seleciona o elemento <meta> pelo atributo name
    let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

    $(document).on("click", ".addCart", function(event){
        event.preventDefault();

        let variacao_id =  $(this).data('variacao_id');
        let produto_id =  $(this).data('produto_id');
        let valor_varejo =  $(this).data('valor_varejo');
        let valor_atacado =  $(this).data('valor_atacado');
        let descricao =  $(this).data('descricao');
        let path =  $(this).data('path');
        let action =  $(this).data('action');
        let quantidade = +$('#quantidade-produto-'+variacao_id).val();// Usando jQuery para pegar o valor do input e converter para inteiro

       let jsonBody =  JSON.stringify(
            {
                variacao_id: variacao_id,
                produto_id: produto_id ,
                quantidade:quantidade,
                path:path,
                descricao:descricao,
                valor: (quantidade >= 5) ?  valor_atacado : valor_varejo
            }
        )
        //faz a requisção post
        fetchPost(csrfTokenMeta,jsonBody,action, 'alert');
        loadCountItemCart();
    });

    /***
     *
     * */
    let loadCountItemCart = function(user_id =1){

        // Uso da função
        (async () => {
            let params = { userId: user_id };
            let data = await fetchGet("http://127.0.0.1/site-loja/countCart", params);
            if (data) {
                // Faça algo com os dados retornados
                //console.log(data.total);
                $('.cart-badge').text(data.total);
            } else {
                // Manipular o caso de erro, se necessário
                console.log('A função fetchGet falhou.');
            }
        })();
    }



    Livewire.on('postAdded', postId => {
        alert('A post was added with the id of: ' + postId);
    })

    /***
     *
     * */
    loadCountItemCart();
});

document.addEventListener('DOMContentLoaded', function () {
    window.livewire.on('mensagem', (data) => {
        Swal.fire({
            position: "top-end",
            icon: data.icon,
            title: data.titulo ,
            showConfirmButton: false,
            timer: 1500
        });
    });
});



/***
 *  *** AÇÃO DE QUANTIDADE
 * */
document.addEventListener("DOMContentLoaded", function() {
    const botoesSubtrair = document.querySelectorAll('.comet-icon-subtract');
    const botoesAdicionar = document.querySelectorAll('.comet-icon-add');
    const inputsQuantidade = document.querySelectorAll('.comet-v2-input-number-input');

    // Para cada input de quantidade
    inputsQuantidade.forEach(function(inputQuantidade) {
        inputQuantidade.addEventListener('input', function() {
            const quantidadeMaxima = $(this).data('quantitytotal'); // Defina a quantidade máxima conforme necessário
            let quantidadeAtual = parseInt(inputQuantidade.value);

            // Verifica se a quantidade digitada ultrapassa a quantidade máxima
            if (quantidadeAtual > quantidadeMaxima) {
                inputQuantidade.value = quantidadeMaxima; // Define a quantidade como a quantidade máxima
            } else if (isNaN(quantidadeAtual) || quantidadeAtual < 1) {
                inputQuantidade.value = 1; // Garante que a quantidade não seja menor que 1
            }

            atualizarBotoes(inputQuantidade,quantidadeMaxima);
        });
    });

    // Para cada botão de subtração
    botoesSubtrair.forEach(function(botaoSubtrair) {
        botaoSubtrair.addEventListener('click', function(event) {
            const inputQuantidade = event.target.closest('.comet-v2-input-number').querySelector('.comet-v2-input-number-input');
            let quantidadeAtual = parseInt(inputQuantidade.value);
            if (quantidadeAtual > 1) {
                inputQuantidade.value = quantidadeAtual - 1;
                atualizarBotoes(inputQuantidade);
            }
        });
    });

    // Para cada botão de adição
    botoesAdicionar.forEach(function(botaoAdicionar) {
        botaoAdicionar.addEventListener('click', function(event) {
            const inputQuantidade = event.target.closest('.comet-v2-input-number').querySelector('.comet-v2-input-number-input');
            let quantidadeAtual = parseInt(inputQuantidade.value);
            let quantidadeMaxima = $(this).data('quantitytotal'); // Defina a quantidade máxima conforme necessário
            if (quantidadeAtual < quantidadeMaxima) {
                inputQuantidade.value = quantidadeAtual + 1;
                atualizarBotoes(inputQuantidade,quantidadeMaxima);
            }
        });
    });

    // Função para atualizar o estado dos botões com base na quantidade
    function atualizarBotoes(inputQuantidade,quantidadeMaxima) {
        let quantidadeAtual = parseInt(inputQuantidade.value);
        const botaoSubtrair = inputQuantidade.closest('.comet-v2-input-number').querySelector('.comet-icon-subtract');
        const botaoAdicionar = inputQuantidade.closest('.comet-v2-input-number').querySelector('.comet-icon-add');
        //var quantidadeMaxima = 10; // Defina a quantidade máxima conforme necessário

        if (quantidadeAtual === 1) {
            botaoSubtrair.classList.add('comet-v2-input-number-btn-disabled');
        } else {
            botaoSubtrair.classList.remove('comet-v2-input-number-btn-disabled');
        }

        if (quantidadeAtual === quantidadeMaxima) {
            botaoAdicionar.classList.add('comet-v2-input-number-btn-disabled');
        } else {
            botaoAdicionar.classList.remove('comet-v2-input-number-btn-disabled');
        }
    }
});
