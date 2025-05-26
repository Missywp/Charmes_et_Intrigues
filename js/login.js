var togglePassView = false;
        document.getElementById("viewpass").addEventListener("click", function () {
            togglePassView = !togglePassView;
            var tipoatt = togglePassView ? "text" : "password";
            document.getElementById("passinput").setAttribute("type", tipoatt);
        });

        document.getElementById('formLogin').addEventListener('submit',
            function(event){
                event.preventDefault(); // evita que recarregue a página
                const formData = new FormData(this);
                const data = new URLSearchParams(formData).toString();

                fetch('php/login.php?' + data) // endereço
                .then(response => response.json())//trata a resposta
                .then(d => {
                    if (d.resp === 'sucesso') {
                        window.location.href = 'menu.html'; // redireciona para o menu
                    } else {
                        alert(d.resp); // mostra mensagem de erro
                    }
                })
                .catch((error)=>{
                    console.error('Error:', error);
                });
            });