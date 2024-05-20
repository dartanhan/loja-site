
let fetchGet = async function(url, params = {}) {
    try {
        // Construir a URL com parâmetros de consulta
        let queryString = new URLSearchParams(params).toString();
        let fullUrl = url + (queryString ? `?${queryString}` : '');

        let response = await fetch(fullUrl, {
            method: 'GET',
        });

        // Verificar se a resposta foi bem-sucedida
        if (!response.ok) {
            throw new Error('Erro ao executar função GET!');
        }

        // Retornar os dados em formato JSON
        let data = await response.json();

        if (data.success) {
            return data;
        } else {
            // Se a resposta não tiver sucesso, lance um erro ou retorne algo indicando falha
            throw new Error('Ação não foi bem-sucedida');
        }
    } catch (error) {
        // console.error('Erro ao adicionar ao carrinho:', error);
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: error.message, // Use error.message para obter a mensagem de erro
            showConfirmButton: false,
            timer: 1500
        });
        // Retorne null ou outro valor indicando falha, se necessário
        return null;
    }
};

let fetchPost = function(csrfTokenMeta, jsonBody,action, tipoRetorno){
    fetch(action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfTokenMeta
        },
        body:jsonBody
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao excutar função!');
            }
            return response.json();
        })
        .then(data => {
            // Manipular a resposta do backend, se necessário
           // console.log(data);
            if(data.success){
                // console.log(data.message);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

            }
        })
        .catch(error => {
            //  console.error('Erro ao adicionar ao carrinho:', error);
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: error,
                showConfirmButton: false,
                timer: 1500
            });
        });
}
