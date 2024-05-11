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

    $(document).on("click", ".addCart", function(event){
        event.preventDefault();

        // Seleciona o elemento <meta> pelo atributo name
        let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        let variacao_id =  $(this).data('variacao_id');
        let produto_id =  $(this).data('produto_id');
        let categoria_id =  $(this).data('categoria_id');
        let descricao =  $(this).data('descricao');
        let path =  $(this).data('path');
        let action =  $(this).data('action');
        let quantidade = +$('#quantidade-produto-'+variacao_id).val();// Usando jQuery para pegar o valor do input e converter para inteiro

        console.log(variacao_id,quantidade);
return false;
        $.ajax({
            url: fncUrl() + "/cart/", //product.store
            cache: false,
            type:'post',
            data:{ // Objeto de dados que você deseja enviar
                variacao_id: variacao_id, // Informação adicional que você quer passar
                produto_id: produto_id,
                categoria_id: categoria_id,
                descricao: descricao,
                path: path,
                action: action,
                _token: csrfTokenMeta
            },
            dataType:'json',
            success: function(response){
                 console.log(response);
                 return false;
                Swal.fire({
                    title: 'Atualizado!',
                    text: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                table.destroy();
                getdata();
            },
            error:function(response){
                // console.log(response);
                swalWithBootstrapButtons.fire({
                    title: 'Error!',
                    text: response.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
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
