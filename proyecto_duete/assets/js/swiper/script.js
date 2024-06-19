//script para carrusel de productos de la página principal.
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints : {
    0: {
      slidesPerView: 1,
    },
    550: {
      slidesPerView: 2,
    },
    700: {
      slidesPerView: 3,
    },
    1200: {
      slidesPerView: 4,
    },
  }

  });

  var swiper = new Swiper(".swiperProductosRel", {
    slidesPerView: 6,
    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints : {
    0: {
      slidesPerView: 1,
    },
    550: {
      slidesPerView: 2,
    },
    700: {
      slidesPerView: 3,
    },
    1200: {
      slidesPerView: 4,
    },
  }

  });



//script para botón de ver contraseña de formulario de registro e iniciar sesión.
document.addEventListener("DOMContentLoaded", function() {
  const pass1 = document.getElementById("ingresarContraseñaLogin"),
  pass2 = document.getElementById("ingresarContraseñaRegistro"),
  icon1 = document.querySelector(".verContraseña");

  icon1.addEventListener("click", () => {
    if (pass1 == null) {
      verPassword(pass2, icon1);
    }
    else {
      verPassword(pass1, icon1);
    }
  });

  function verPassword(p, i) {
    if (p.type === "password") {
      p.type = "text";
      i.classList.remove('bi-eye-slash');
      i.classList.add('bi-eye');
    } else{
      p.type = "password";
      i.classList.add('bi-eye-slash');
      i.classList.remove('bi-eye');
    }
  }

});

function verContraseñaEditar(fieldId) {
  const field = document.getElementById(fieldId);
  const icon = document.querySelector(`#ver${fieldId}`);
  if (field.type === 'password') {
      field.type = 'text';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
  } else {
      field.type = 'password';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
  }
}

//script para hacer que algunos mensajes desaparezcan a los 5 segundos.
document.addEventListener('DOMContentLoaded', function(){
  const msgUsuarioRegistrado = document.getElementById('usuarioRegistradoMsg');
  const msgAuthError = document.getElementById('msgAuthError');
  const msgAltaExitosa = document.getElementById('msgAltaExitosa');
  const msgDanger = document.getElementById('msgDanger');
  
  
  if(msgUsuarioRegistrado){
    msgTemporal(msgUsuarioRegistrado, 4000);
  }
  if (msgAuthError){
    msgTemporal(msgAuthError, 4000);
  }
  if (msgAltaExitosa){
    msgTemporal(msgAltaExitosa, 3000);
  }
  if(msgDanger){
    msgTemporal(msgDanger, 3000);
  }

  function msgTemporal(msg, tiempo) {
    setTimeout(function() {
        msg.classList.add('fade-out');
        msg.addEventListener('transitionend', function() {
            msg.remove();
        });
    }, tiempo);
}
});

//script para validar formulario de "quiero recibir promociones" del lado del cliente.
document.addEventListener("DOMContentLoaded", function() {
  var formulario = document.getElementById("formularioProm");
  formulario.addEventListener("submit", function(event) {
    var emailInput = document.getElementById("ingresarEmailProm");
    var mensajeError = document.getElementById("promocionesRequired");

    if (!emailInput.value.trim()) {
      mensajeError.style.display = "block";
      event.preventDefault();
    } else {
      mensajeError.style.display = "none";
    }
  });
});

//script para validar formulario de login del lado del cliente.
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    var email = document.getElementById('ingresarEmailLogin');
    var password = document.getElementById('ingresarContraseñaLogin');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passError');
    var valid = true;
    
    function validarLogin(input, error){
      if (!input) {
        error.style.display = 'block';
        valid = false;
      }
      else {
        error.style.display = 'none';
      }
    }

    validarLogin(email.value.trim(), emailError);
    validarLogin(password.value.trim(), passwordError);
    if (!valid) {
       event.preventDefault();
    }

    email.addEventListener('input', function() {
      emailError.style.display = 'none';
    });
  
    password.addEventListener('input', function() {
      passwordError.style.display = 'none';
    });
});
});

//script para validar formulario de registro del lado del cliente.
document.addEventListener("DOMContentLoaded", function() {
  // Obtener todos los campos de entrada y la casilla de verificación
  var campos = [
    'ingresarNombreRegistro',
    'ingresarApellidoRegistro',
    'ingresarUsuarioRegistro',
    'ingresarTelefonoRegistro',
    'ingresarEmailRegistro',
    'ingresarContraseñaRegistro',
    'ingresarContraseña2Registro'
  ];

  var tyc = document.getElementById('aceptarTYC');

  campos.forEach(function(campoId) {
    var campo = document.getElementById(campoId);
    var errorId = campoId + 'Required';
    var error = document.getElementById(errorId);

    // Agregar manejadores de eventos para el campo de entrada
    campo.addEventListener('input', function() {
      error.style.display = 'none';
    });
  });

  // Agregar manejador de eventos para la casilla de verificación de términos y condiciones
  tyc.addEventListener('change', function() {
    var tycError = document.getElementById('aceptarTYCRequired');
    tycError.style.display = 'none';
  });

  document.getElementById('registroForm').addEventListener('submit', function(event) {
    var valid = true;

    campos.forEach(function(campoId) {
      var campo = document.getElementById(campoId);
      var errorId = campoId + 'Required';
      var error = document.getElementById(errorId);

      // Validar campo
      var valor = campo.value.trim();
      if (!valor) {
        error.style.display = 'block';
        valid = false;
      }
    });

    // Validar términos y condiciones
    if (!tyc.checked) {
      var tycError = document.getElementById('aceptarTYCRequired');
      tycError.style.display = 'block';
      valid = false;
    }

    // Prevenir el envío del formulario si no es válido
    if (!valid) {
      event.preventDefault();
    }
  });
});

//validacion de formulario de atencion al cliente del lado del cliente.
document.addEventListener("DOMContentLoaded", function(){
  var camposAt = [
      'ingresarNombreAt',
      'ingresarApellidoAt',
      'ingresarTelefonoAt',
      'ingresarEmailAt',
      'ingresarComentarioAt'
  ];

  var motivos = document.querySelectorAll('.campoForm[type="radio"]');

  camposAt.forEach(function(campoAtId) {
      var campo = document.getElementById(campoAtId);

      campo.addEventListener('input', function() {
          campo.classList.add("campoForm");
          campo.classList.remove("campoFormError");
      });
  });

  motivos.forEach(radio => {
      radio.addEventListener('change', function() {
          motivos.forEach(r => {
              r.classList.remove('campoFormError');
              r.classList.add('campoForm');
          });
      });
  });

  document.getElementById('atc-form').addEventListener('submit', function(event){
      var formValido = true;

      camposAt.forEach(function(campoAtId) {
          var campo = document.getElementById(campoAtId);
          var valor = campo.value.trim();
          if (!valor) {
              campo.classList.remove("campoForm");
              campo.classList.add("campoFormError");
              formValido = false;
          }
      });

      let motivoSeleccionado = false;
      motivos.forEach(radio => {
          if (radio.checked) {
              motivoSeleccionado = true;
          }
      });

      if (!motivoSeleccionado) {
          motivos.forEach(radio => {
              radio.classList.remove('campoForm');
              radio.classList.add('campoFormError');
          });
          formValido = false;
      }

      if (!formValido) {
          event.preventDefault();
      }

  });
});

function formularioAtEnviado() {
  var formularioAt = document.getElementById('atc-form');
  var imagenAt = document.getElementById('formAtEnviado');
  var tituloAt = document.getElementById('tituloFormAt');

  ocultar(formularioAt);
  ocultar(tituloAt);
  mostrar(imagenAt);

  function ocultar(p){
    p.style.display = 'none';
  }
  function mostrar(p){
    p.style.display = 'block';
  }
}

//script para hacer que se pueda incrementar o decrementar el valor en la vista de un producto.
document.addEventListener("DOMContentLoaded", function(){
  var input = document.getElementById('valor');

document.getElementById('botonIncrementar').addEventListener('click', function() {
    var valorActual = parseInt(input.value) || 1; 
    input.value = valorActual + 1;
});

// Evento para decrementar el valor
document.getElementById('botonDecrementar').addEventListener('click', function() {
    var valorActual = parseInt(input.value) || 1; 
    if (valorActual > 1) { 
        input.value = valorActual - 1;
    }
});

// Validar la entrada para permitir solo números
input.addEventListener('input', function() {
    // Obtener el valor actual del campo de entrada
    var value = this.value;

    // Limpiar el valor de entrada dejando solo los números
    this.value = value.replace(/\D/g, ''); // Remover todo lo que no sea un número

    // Asegurar que no se permita el ingreso de números negativos
    if (parseInt(this.value) < 1) {
        this.value = 1;
    }
});

input.addEventListener('blur', function() {
  if (this.value === '' || parseInt(this.value) < 1) {
      this.value = 1;
  }
});
});


//script para mostrar un modal al añadir un producto al carrito o cuando no se pueda añadir.
function agregarAlCarrito(idProducto) {
  // Obtén el formulario correspondiente
  var form = document.getElementById('form_' + idProducto);
  var formData = new FormData(form);

  // Realiza la solicitud AJAX
  fetch(form.action, {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'error') {
        if (data.message === 'No stock') {
            // Muestra el modal de stock insuficiente
            var stockInsuficienteModal = new bootstrap.Modal(document.getElementById('stockInsuficienteModal'));
            stockInsuficienteModal.show();
        } else {
            // Si hay otro tipo de error, muestra el modal de login
            var loginCarritoModal = new bootstrap.Modal(document.getElementById('loginCarritoModal'));
            loginCarritoModal.show();
        }
    } else {
        // Si se agrega correctamente, muestra el modal de confirmación
        var añadirAlCarritoModal = new bootstrap.Modal(document.getElementById('añadirAlCarritoModal'));
        añadirAlCarritoModal.show();
    }
})
.catch(error => {
    console.error('Error:', error);
});
}

//Script para añadir varios productos a la vez
function agregarAlCarritoVarios(idProducto) {
  // Obtén el formulario correspondiente
  var form = document.getElementById('form_' + idProducto);
  var cantidad = document.querySelector('input[name="cantidadProducto"]').value;
  form.querySelector('input[name="cantidad"]').value = cantidad;
  var formData = new FormData(form);

  // Realiza la solicitud AJAX
  fetch(form.action, {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'error') {
        if (data.message === 'No stock') {
            // Muestra el modal de stock insuficiente
            var stockInsuficienteModal = new bootstrap.Modal(document.getElementById('stockInsuficienteModal'));
            stockInsuficienteModal.show();
        } else {
            // Si hay otro tipo de error, muestra el modal de login
            var loginCarritoModal = new bootstrap.Modal(document.getElementById('loginCarritoModal'));
            loginCarritoModal.show();
        }
    } else {
        // Si se agrega correctamente, muestra el modal de confirmación
        var añadirAlCarritoModal = new bootstrap.Modal(document.getElementById('añadirAlCarritoModal'));
        añadirAlCarritoModal.show();
    }
})
.catch(error => {
    console.error('Error:', error);
});
}

document.addEventListener('DOMContentLoaded', function () {
  var editProductModal = document.getElementById('editarProductoCarModal');
  
  editProductModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Botón que activó el modal
      var name = button.getAttribute('data-name');
      var marca = button.getAttribute('data-marca');
      var imagen = button.getAttribute('data-imagen');
      var price = button.getAttribute('data-price');
      var stock = button.getAttribute('data-stock');
      var qty = button.getAttribute('data-qty');
      var rowid = button.getAttribute('data-rowid');

      console.log('Valor de rowid:', rowid);

      // Actualizar el contenido del modal con la información del producto
      document.getElementById('modalNombreProd').textContent = name;
      document.getElementById('modalMarcaProd').textContent = marca;
      document.getElementById('modalImagenProd').src = imagen;
      document.getElementById('modalPrecioProd').textContent = price;
      document.getElementById('modalStockProd').textContent = stock;
      document.getElementById('valor').value = qty;
      
      document.getElementById('modalRowId').value = rowid;
      document.getElementById('modalQtyHidden').value = qty;
  });

  document.getElementById('enviarModCarrito').addEventListener('click', function () {
      var form = document.getElementById('modificarCarrito');
      document.getElementById('modalQtyHidden').value = document.getElementById('valor').value;
      document.getElementById('modalStockHidden').value = document.getElementById('modalStockProd').textContent;
      form.submit();
  });
});

