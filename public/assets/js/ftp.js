document.querySelectorAll('.button').forEach(button => button.addEventListener('click', e => {
    if (!button.classList.contains('loading')) {
        button.classList.add('loading');
        const href = button.parentElement.getAttribute('href'); // Obtener el atributo href del elemento padre (la etiqueta <a>)
        console.log('URL a redirigir:', href); // Agrega este console.log para depurar
        setTimeout(() => {
            // Aquí puedes redirigir al usuario a la ruta deseada después de la animación de carga.
            window.location.href = href ; // Agrega '#ruta_pre' a la URL para redirigir al elemento con id="ruta_pre"
        }, 3700);
    }
    e.preventDefault();
}));
