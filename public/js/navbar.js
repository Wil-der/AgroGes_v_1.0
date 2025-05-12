document.addEventListener('DOMContentLoaded', function() {
    const sidebarContainer = document.getElementById('container-slider');
    const mainContent = document.getElementById('container-content');
    const toggleBtn = document.getElementById('checkbox2');
    const footer = document.getElementById('container-footer');
    const overlayContent = document.getElementById('overlay-content');
    const overlayFooter = document.getElementById('overlay-footer');

    // Función para abrir y cerrar el sidebar
    const btnEmpresa = document.getElementById('btn-empresas');
    const opcionEmpresas = document.getElementById('opcion-empresas');
    const btnEspecialidad = document.getElementById('btn-espacialidad');
    const opcionEspecialidad = document.getElementById('opcion-espacialidad');
    const btnParteDiario = document.getElementById('btn-parte-diario');
    const opcionParteDiario = document.getElementById('opcion-parte-diario');
    const btnUsuarios = document.getElementById('btn-usuarios');
    const opcionUsuarios = document.getElementById('opcion-usuarios');

    const ids = [
        { btnId: 'btn-empresas', opcionId: 'opcion-empresas' },
        { btnId: 'btn-espacialidad', opcionId: 'opcion-espacialidad' },
        { btnId: 'btn-parte-diario', opcionId: 'opcion-parte-diario' },
        { btnId: 'btn-usuarios', opcionId: 'opcion-usuarios' },
      ];
      
      const controles = ids
        .map(({ btnId, opcionId }) => {
          const boton = document.getElementById(btnId);
          const opcion = document.getElementById(opcionId);
          return boton && opcion ? { boton, opcion } : null;
        })
        .filter(Boolean);
      
      function cerrarTodosMenos(actual) {
        controles.forEach(({ opcion }) => {
          if (opcion !== actual) {
            opcion.classList.remove('abrir-menu');
            opcion.classList.add('cerrar-menu');
          }
        });
      }
      
      controles.forEach(({ boton, opcion }) => {
        boton.addEventListener('click', () => {
          const estaAbierto = opcion.classList.contains('abrir-menu');
      
          cerrarTodosMenos(opcion);
      
          if (estaAbierto) {
            opcion.classList.remove('abrir-menu');
            opcion.classList.add('cerrar-menu');
          } else {
            opcion.classList.remove('cerrar-menu');
            opcion.classList.add('abrir-menu');
          }
        });
      });
      

        // Función para alternar el sidebar
    function toggleSidebar() {
        if (!sidebarContainer.classList.contains('closed') &&
            !sidebarContainer.classList.contains('opened')) {
                sidebarContainer.classList.toggle('opened');
                mainContent.classList.toggle('right');
                footer.classList.toggle('right');
                overlayContent.classList.toggle('active');
                overlayFooter.classList.toggle('active');
            }else{
                sidebarContainer.classList.toggle('opened');
                sidebarContainer.classList.toggle('closed');
                mainContent.classList.toggle('right');
                mainContent.classList.toggle('left');
                footer.classList.toggle('right');
                footer.classList.toggle('left');
                overlayContent.classList.toggle('active');
                overlayFooter.classList.toggle('active');
            }
    }
    
    // Evento para el botón de toggle
    toggleBtn.addEventListener('change', toggleSidebar);
    
    // Cerrar sidebar al hacer clic en cualquier enlace del menú
    
});