document.querySelectorAll('.texto-visible').forEach(div => {
    div.addEventListener('click', function () {
        const container = this.parentElement;
        const textarea = container.querySelector('.textarea-edicion');
        const guardar = container.querySelector('.btn-guardar');

        textarea.value = this.textContent.trim();
        this.style.display = 'none';
        textarea.style.display = 'block';
        guardar.style.display = 'inline-block';
    });
});

document.querySelectorAll('.btn-guardar').forEach(boton => {
    boton.addEventListener('click', function () {
        const container = this.parentElement;
        const id = container.dataset.id;
        const campo = container.dataset.campo;
        const textarea = container.querySelector('.textarea-edicion');
        const textoVisible = container.querySelector('.texto-visible');
        const valor = textarea.value.trim();

        fetch(location.href, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, campo, valor })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    textoVisible.textContent = valor;
                    textarea.style.display = 'none';
                    boton.style.display = 'none';
                    textoVisible.style.display = 'block';
                } else {
                    alert('Error al guardar');
                }
            });
    });
});