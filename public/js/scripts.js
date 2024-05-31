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

function addToCart(variacaoId, produtoId, valorVarejo, valorAtacado) {
    let quantityElement = document.getElementById('quantidade-produto-' + variacaoId);
    let quantityTotal = parseInt(quantityElement.getAttribute('quantitytotal'));
    let quantity = parseInt(quantityElement.value);

    // Disparar evento Livewire com os valores necessários
    Livewire.emit('addCart', variacaoId, produtoId, valorVarejo, valorAtacado, quantityTotal, quantity);
}

$(document).ready(function() {

// Seleciona o elemento <meta> pelo atributo name
   // let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // $(document).on("click", "addCart", function(event){
    //     event.preventDefault();
    //
    //     let variacao_id =  $(this).data('variacao_id');
    //     let produto_id =  $(this).data('produto_id');
    //     let valor_varejo =  $(this).data('valor_varejo');
    //     let valor_atacado =  $(this).data('valor_atacado');
    //     let quantidadeTotal =  $(this).data('quantityTotal');
    //     let quantidade = +$('#quantidade-produto-'+variacao_id).val();// Usando jQuery para pegar o valor do input e converter para inteiro
    //
    //     // Chamar a função Livewire passando os parâmetros
    //     Livewire.emit('addCart', variacao_id, produto_id,valor_varejo, valor_atacado, quantidadeTotal,quantidade);
    //
    // });


    /**
     * Exibe mesnsagem confirmação de exclusão de produto do carrinho
     * Caso sim, chama função no componente CartShow.php para exclusão
     * */
    Livewire.on('confirmRemoveItem', pedidoProdutoId => {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Deseja mesmo remover este item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, remover!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('removeItemToCart', pedidoProdutoId);

            }
        });
    });

    /***
     *
     * */
   // loadCountItemCart();
});

document.addEventListener('livewire:load', function () {
    Livewire.on('mensagem', (data) => {
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
