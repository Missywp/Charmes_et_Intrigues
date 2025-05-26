fetch('php/exibirLivros.php')
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById('livros');

    if (data.length === 0) {
        container.innerHTML = "<p>Nenhum livro cadastrado ainda.</p>";
        return;
    }

    data.forEach(livro => {
        const div = document.createElement('div');
        div.classList.add('container-textarea');
        div.innerHTML = `
            <div>
                <strong>${livro.nome}</strong><br>
                <p>${livro.resenha}</p>
            </div>
        `;
        container.appendChild(div);
    });
  })
  .catch(err => {
    console.error('Erro ao buscar livros:', err);
    document.getElementById('livros').innerText = "Erro ao carregar livros.";
  });
