let users = JSON.parse(localStorage.getItem('users')) || [];
let loggedUser = null;
let history = JSON.parse(localStorage.getItem("history")) || [];

// Autos con imágenes locales
const cars = [
  { name: "Toyota Corolla", img: "images/toyota.jpg" },
  { name: "Honda Civic", img: "images/honda.jpg" },
  { name: "Ford Escape", img: "images/ford.jpg" },
  { name: "Chevrolet Camaro", img: "images/camaro.jpg" }
];

// Pantallas
function showRegister() {
  document.getElementById("loginScreen").style.display = "none";
  document.getElementById("registerScreen").style.display = "block";
}

function showLogin() {
  document.getElementById("registerScreen").style.display = "none";
  document.getElementById("loginScreen").style.display = "block";
}

// Registro
function register() {
  const name = document.getElementById("regName").value.trim();
  const age = parseInt(document.getElementById("regAge").value);
  const pass = document.getElementById("regPass").value;

  const nameRegex = /^[a-zA-Z0-9\s]+$/;
  const passRegex = /^[0-9]+$/;

  if (!name || !age || !pass) {
    alert("Completa todos los campos.");
    return;
  }

  if (!nameRegex.test(name)) {
    alert("El nombre solo puede contener letras y números.");
    return;
  }

  if (age < 18) {
    alert("Debes tener al menos 18 años para registrarte.");
    return;
  }

  if (pass.length < 6) {
    alert("La contraseña debe tener al menos 6 dígitos.");
    return;
  }

  if (!passRegex.test(pass)) {
    alert("La contraseña solo puede contener números.");
    return;
  }

  users.push({ user: name, age: age, pass: pass });
  localStorage.setItem('users', JSON.stringify(users));
  alert("Registro exitoso.");
  showLogin();
}

// Login
function login() {
  const user = document.getElementById("loginUser").value.trim();
  const pass = document.getElementById("loginPass").value;
  let found = users.find(u => u.user === user && u.pass === pass);
  if (found) {
    loggedUser = found;
    document.getElementById("loginScreen").style.display = "none";
    document.getElementById("mainScreen").style.display = "block";
    listCars();
  } else {
    alert("Usuario o contraseña incorrectos.");
  }
}

// Mostrar autos
function listCars() {
  let html = '';
  cars.forEach(car => {
    html += `
      <div class="car-card">
        <img src="${car.img}" alt="${car.name}">
        <h3>${car.name}</h3>
        <button onclick="openForm('${car.name}', 'Reserva')">Reservar</button>
        <button onclick="openForm('${car.name}', 'Alquiler')">Alquilar Hoy</button>
      </div>
    `;
  });
  document.getElementById("carList").innerHTML = html;
}

// Buscar autos
function searchCars() {
  let input = document.getElementById("searchInput").value.toLowerCase();
  let cards = document.querySelectorAll(".car-card");
  cards.forEach(card => {
    let carName = card.querySelector("h3").innerText.toLowerCase();
    card.style.display = carName.includes(input) ? "block" : "none";
  });
}

// Formulario de reserva/alquiler
function openForm(car, tipo) {
  if (!loggedUser) {
    alert("Debes iniciar sesión.");
    return;
  }
  document.getElementById("formScreen").style.display = "block";
  document.getElementById("formScreen").innerHTML = `
    <h2>${tipo} de ${car}</h2>
    <input type="number" id="days" placeholder="Cantidad de días">
    <button onclick="goToPayment('${car}', '${tipo}')">Confirmar y Pagar</button>
    <button onclick="document.getElementById('formScreen').style.display='none'">Cancelar</button>
  `;
  window.scrollTo(0, document.body.scrollHeight);
}

// Pantalla de pago
function goToPayment(car, tipo) {
  if (!loggedUser) {
    alert("Debes iniciar sesión.");
    return;
  }
  document.getElementById("paymentScreen").style.display = "block";
  document.getElementById("paymentScreen").innerHTML = `
    <h2>Selecciona método de pago</h2>
    <div id="paymentOptions">
      <img src="images/tarjeta.jpg" onclick="payNow('${car}', '${tipo}', 'Tarjeta')">
      <img src="images/qr.png" onclick="payNow('${car}', '${tipo}', 'QR')">
    </div>
  `;
  window.scrollTo(0, document.body.scrollHeight);
}

// Procesar pago
function payNow(car, tipo, metodo) {
  if (metodo === 'Tarjeta') {
    let carnet = prompt("Ingresa número de tarjeta:");
    if (carnet) {
      finishTransaction(car, tipo, metodo);
    }
  } else {
    alert("Código QR generado.");
    finishTransaction(car, tipo, metodo);
  }
}

// Finalizar transacción
function finishTransaction(car, tipo, metodo) {
  history.push(`${tipo} de ${car} pagado por ${metodo}`);
  localStorage.setItem("history", JSON.stringify(history));
  alert(`✅ ${tipo} realizado con éxito.`);
  document.getElementById("formScreen").style.display = "none";
  document.getElementById("paymentScreen").style.display = "none";
  viewHistory();
}

// Historial
function viewHistory() {
  let saved = JSON.parse(localStorage.getItem("history")) || [];
  let html = "<h2>📜 Historial</h2>";
  if (saved.length === 0) {
    html += "<p>Sin historial aún.</p>";
  } else {
    html += "<ul>";
    saved.forEach(item => {
      html += `<li>${item}</li>`;
    });
    html += "</ul>";
  }
  document.getElementById("historyList").innerHTML = html;
}

