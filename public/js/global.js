// document.addEventListener('DOMContentLoaded', function () {
//     const botones = document.querySelectorAll('.btn-redirect');
//     const contenedor = document.getElementById('content-main');
//     const loader = document.querySelector('#overlay-loader');

//     // Función para cargar contenido por URL
//     async function cargarContenido(url) {
//         try {
//             loader.style.display = 'block';
//             const response = await fetch(url);
//             if (!response.ok) throw new Error('Error al cargar el contenido');

//             const html = await response.text();
//             contenedor.innerHTML = html;
//         } catch (error) {
//             console.error('Error:', error);
//             contenedor.innerHTML = '<h1>Error al cargar el contenido.</h1>';
//         } finally {
//             loader.style.display = 'none';
//         }
//     }

//     // Click en los botones
//     botones.forEach((boton) => {
//         boton.addEventListener('click', async (e) => {
//             e.preventDefault();
//             const url = boton.dataset.url;

//             await cargarContenido(url);

//             // Cambiar URL en la barra sin recargar
//             history.pushState({}, '', url);
//         });
//     });

//     // Manejar botones del navegador (atrás/adelante)
//     window.addEventListener('popstate', function () {
//         const url = location.pathname;
//         cargarContenido(url);
//     });
// });


document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
