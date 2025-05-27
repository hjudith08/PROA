
document.addEventListener('DOMContentLoaded', function() {
  
  // Manejo del input de archivo
  const fileInput = document.getElementById('taskFile');
  const fileButton = fileInput.nextElementSibling;
  const fileButtonText = fileButton.querySelector('span');

  fileInput.addEventListener('change', function(e) {
    if (this.files && this.files.length > 0) {
      fileButtonText.textContent = this.files[0].name;
      
      // Cambiar estilo cuando hay archivo seleccionado
      fileButton.style.backgroundColor = '#f0f0f0';
    } else {
      fileButtonText.textContent = 'Subir archivo';
      fileButton.style.backgroundColor = 'var(--color-blanco)';
    }
  });

  // Manejo del formulario
  const taskForm = document.getElementById('taskForm');
  
  taskForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Obtener valores del formulario
    const taskData = {
      scheduleDate: document.getElementById('scheduleDate').value,
      title: document.getElementById('taskTitle').value,
      description: document.getElementById('taskDescription').value,
      dueDate: document.getElementById('dueDate').value,
      score: document.getElementById('taskScore').value,
      file: fileInput.files[0] ? fileInput.files[0].name : null
    };
    
    // Validación básica
    if (!taskData.title || !taskData.description || !taskData.dueDate) {
      alert('Por favor complete los campos obligatorios: Título, Descripción y Fecha de entrega');
      return;
    }
    
    // Validar puntuación
    if (taskData.score && (isNaN(taskData.score) || taskData.score <= 0)) {
      alert('La puntuación debe ser un número mayor a 0');
      return;
    }
    
    // Aquí iría la lógica para enviar los datos al servidor
    console.log('Datos de la tarea:', taskData);
    alert('Tarea creada exitosamente!');
    
    // Resetear formulario
    taskForm.reset();
    fileButtonText.textContent = 'Subir archivo';
    fileButton.style.backgroundColor = 'var(--color-blanco)';
  });

  // Manejo del botón de volver
  const backButton = document.querySelector('.back-button');
  backButton.addEventListener('click', function() {
    // Aquí iría la lógica para volver atrás
    console.log('Volver atrás');
    window.history.back();
  });

  // Mejorar experiencia en móvil para inputs de fecha
  const dateInputs = document.querySelectorAll('input[type="date"]');
  dateInputs.forEach(input => {
    // Establecer fecha mínima como hoy
    const today = new Date().toISOString().split('T')[0];
    input.setAttribute('min', today);
    
    // Mejorar visualización en móvil
    if (/Mobi/.test(navigator.userAgent)) {
      input.addEventListener('focus', function() {
        this.blur(); // Cerrar teclado en móvil
        setTimeout(() => {
          this.showPicker(); // Abrir selector de fecha nativo
        }, 100);
      });
    }
  });
});