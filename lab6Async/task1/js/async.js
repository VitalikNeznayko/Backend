window.onload = function () {
  fetch("checkSession.php")
    .then((response) => response.json())
    .then((jsonData) => {
      var logged = jsonData.logged;
      if (logged) {
        document.getElementById("register").style.display = "none";
        document.getElementById("logIn").style.display = "none";
        document.getElementById("userProfile").style.display = "block";
        AsyncGetContent();
      }
    });
};

function AsyncRegister() {
  let email = document.getElementById("reg-email").value;
  let login = document.getElementById("reg-login").value;
  let password = document.getElementById("reg-password").value;

  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "register",
      email: email,
      login: login,
      password: password,
    }),
  })
    .then((response) => {
      return response.text();
    })
    .then((message) => {
      if (message === "register") {
        document.getElementById("reg-email").value = "";
        document.getElementById("reg-login").value = "";
        document.getElementById("reg-password").value = "";

        document.getElementById("register").style.display = "none";
        document.getElementById("logIn").style.display = "none";
        document.getElementById("userProfile").style.display = "block";
        AsyncGetContent();
      } else {
        var table = document.getElementById("table-register");
        var tr = document.createElement("tr");
        tr.id = "reg-error";
        var emptytd = document.createElement("td");
        tr.appendChild(emptytd);
        var td = document.createElement("td");
        if (message === "No login or password was entered") {
          td.innerHTML = "Було не введено логін або пароль";
        } else if (message === "Login already exists") {
          td.innerHTML = "Такий логін вже існує";
        } else if (message === "Email already exists") {
          td.innerHTML = "Така пошта вже існує";
        } else if (message === "Password is too short, minimum 8 characters") {
          td.innerHTML = "Пароль занадто короткий, 8 символів мінімум";
        } else {
          td.innerHTML = message;
        }
        tr.appendChild(td);
        table.appendChild(tr);
      }
    })
    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}

function AsyncLogin() {
  var login = document.getElementById("logIn-login").value;
  var password = document.getElementById("logIn-password").value;

  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "logIn",
      login: login,
      password: password,
    }),
  })
    .then((response) => {
      return response.text();
    })
    .then((message) => {
      if (message === "Logged succesfully") {
        document.getElementById("logIn-login").value = "";
        document.getElementById("logIn-password").value = "";

        document.getElementById("register").style.display = "none";
        document.getElementById("logIn").style.display = "none";
        document.getElementById("userProfile").style.display = "block";
        AsyncGetContent();
      } else {
        var table = document.getElementById("table-logIn");
        var tr = document.createElement("tr");
        tr.id = "log-error";
        var emptytd = document.createElement("td");
        tr.appendChild(emptytd);
        var td = document.createElement("td");
        if (message === "Missing login or password") {
          td.innerHTML = "Ви не ввели логін або пароль!";
          tr.appendChild(td);
          table.appendChild(tr);
        } else if (message === "Wrong login or password") {
          td.innerHTML = "Неправильний логін або пароль";
          tr.appendChild(td);
          table.appendChild(tr);
        } else {
          td.innerHTML = message;
          tr.appendChild(td);
          table.appendChild(tr);
        }
      }
    })
    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}

function AsyncGetContent() {
  var t = document.getElementById("bdtable");
  if (t != null) {
    t.remove();
  }

  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "getContent",
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((jsonData) => {
      if (jsonData.length > 0) {
        var parent = document.getElementById("userProfile");

        var table = document.createElement("table");
        table.id = "bdtable";

        var trHeaders = document.createElement("tr");
        Object.keys(jsonData[0]).forEach((key) => {
          var thHeader = document.createElement("th");
          thHeader.innerHTML = key;
          trHeaders.appendChild(thHeader);
        });

        var thEdit = document.createElement("th");
        var thDelete = document.createElement("th");

        thEdit.innerHTML = "edit";
        thDelete.innerHTML = "delete";

        trHeaders.appendChild(thDelete);
        trHeaders.appendChild(thEdit);

        table.appendChild(trHeaders);

        jsonData.forEach((object) => {
          var id = object["id"];
          var trItem = document.createElement("tr");
          for (const key in object) {
            if (Object.hasOwnProperty.call(object, key)) {
              const value = object[key];

              var tdItem = document.createElement("td");
              var inputItem = document.createElement("input");

              inputItem.id = key + "_" + id;
              inputItem.type = "text";
              inputItem.value = value;

              if (key === "id") {
                inputItem.readOnly = true;
              }

              tdItem.appendChild(inputItem);
            }
            trItem.appendChild(tdItem);
          }

          var tdEdit = document.createElement("td");
          var tdDelete = document.createElement("td");

          var btnEdit = document.createElement("button");
          var btnDelete = document.createElement("button");

          btnEdit.innerHTML = "edit";
          btnDelete.innerHTML = "delete";

          btnEdit.id = "edit_" + id;
          btnDelete.id = "delete_" + id;

          btnEdit.onclick = function () {
            var id = this.id.match(/\d+/g)[0];

            var login = document.getElementById("login_" + id);
            var password = document.getElementById("password_" + id);
            var email = document.getElementById("email_" + id);

            if (login && email) {
              AsyncEdit(id, login.value, password.value, email.value);
            } else {
              console.error("Елемент не знайдено для редагування.");
            }
          };

          btnDelete.onclick = function () {
            var id = this.id.match(/\d+/g)[0];
            AsyncDelete(id);
          };

          tdEdit.appendChild(btnEdit);
          tdDelete.appendChild(btnDelete);

          trItem.appendChild(tdEdit);
          trItem.appendChild(tdDelete);
          table.appendChild(trItem);
        });

        parent.appendChild(table);
      }
    })
    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}

function AsyncLogout() {
  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "logOut-button",
    }),
  })
    .then((response) => {
      return response.text();
    })
    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}
function AsyncDelete(id) {
  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "delete",
      id: id,
    }),
  })
    .then((response) => {
      return response.text();
    })
    .then(() => {
      AsyncGetContent();
    })

    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}

function AsyncEdit(id, login, password, email) {
  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "edit",
      id: id,
      login: login,
      password: password,
      email: email,
    }),
  })
    .then((response) => {
      return response.text();
    })
    .then(() => {
      AsyncGetContent();
    })
    .catch((error) => {
      console.error("Помилка запиту:", error);
    });
}

document.body.addEventListener("click", (event) => {
  clickedElementId = event.target.id;
  if (clickedElementId === "show-logIn") {
    document.getElementById("register").style.display = "none";
    document.getElementById("logIn").style.display = "block";
  } else if (clickedElementId === "show-register") {
    document.getElementById("register").style.display = "block";
    document.getElementById("logIn").style.display = "none";
  } else if (clickedElementId === "show-userProfile") {
    document.getElementById("register").style.display = "none";
    document.getElementById("logIn").style.display = "none";
    document.getElementById("userProfile").style.display = "block";
  } else if (clickedElementId === "reg-button") {
    AsyncRegister();
  } else if (clickedElementId === "logIn-button") {
    AsyncLogin();
  } else if (clickedElementId === "update-button") {
    AsyncGetContent();
  } else if (clickedElementId === "logOut-button") {
    document.getElementById("userProfile").style.display = "none";
    document.getElementById("logIn").style.display = "block";
    AsyncLogout();
  }
});
