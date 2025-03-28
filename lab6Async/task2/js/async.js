window.onload = function () {
  AsyncGetContent();
};

function CreateNote(table) {
  var trItem = document.createElement("tr");

  var tdid = document.createElement("td");
  var inputid = document.createElement("input");
  inputid.id = "id_create";
  inputid.readOnly = true;
  tdid.appendChild(inputid);
  trItem.appendChild(tdid);

  var tdtitle = document.createElement("td");
  var inputtitle = document.createElement("input");
  inputtitle.id = "title";
  tdtitle.appendChild(inputtitle);

  var titleError = document.createElement("div");

  titleError.id = "title_error";
  titleError.style.color = "red";
  titleError.style.display = "none";

  tdtitle.appendChild(titleError);

  trItem.appendChild(tdtitle);

  var tdtext = document.createElement("td");
  var textareaText = document.createElement("textarea");
  textareaText.id = "text_create";
  tdtext.appendChild(textareaText);

  var textError = document.createElement("div");

  textError.id = "text_error";
  textError.style.color = "red";
  textError.style.display = "none";

  tdtext.appendChild(textError);

  trItem.appendChild(tdtext);

  var tdButton = document.createElement("td");
  var btnCreate = document.createElement("button");
  btnCreate.id = "create";
  btnCreate.innerHTML = "create";
  btnCreate.onclick = function () {
    var title = document.getElementById("title").value;
    var text = document.getElementById("text_create").value;

    var isValid = true;
    if (title.trim() === "") {
      titleError.innerText = "Це поле обов'язкове.";
      titleError.style.display = "block";
      isValid = false;
    } else {
      titleError.style.display = "none";
    }

    if (text.trim() === "") {
      textError.innerText = "Це поле обов'язкове.";
      textError.style.display = "block";
      isValid = false;
    } else {
      textError.style.display = "none";
    }

    if (isValid) {
      fetch("async.php", {
        method: "POST",
        body: JSON.stringify({
          action: "create",
          title: title,
          text: text,
        }),
      })
        .then((response) => response.text())
        .then(() => {
          AsyncGetContent();
        })
        .catch((error) => {
          console.error("Помилка запиту:", error);
        });
    }
  };
  tdButton.appendChild(btnCreate);
  trItem.appendChild(tdButton);

  table.appendChild(trItem);
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
    .then((response) => response.json())
    .then((jsonData) => {
      var parent = document.getElementById("container");

      var table = document.createElement("table");
      table.id = "bdtable";
      parent.appendChild(table);

      if (jsonData.length > 0) {
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
              if (key === "text") {
                var textItem = document.createElement("textarea");
                textItem.id = key + "_" + id;
                textItem.innerHTML = value;

                var textError = document.createElement("div");
                textError.id = "text_error_" + id;
                textError.style.color = "red";
                textError.style.display = "none";
                tdItem.appendChild(textItem);
                tdItem.appendChild(textError);
              } else if (key === "title") {
                var titleItem = document.createElement("input");
                titleItem.id = key + "_" + id;
                titleItem.type = "text";
                titleItem.value = value;

                var titleError = document.createElement("div");
                titleError.id = "title_error_" + id;
                titleError.style.color = "red";
                titleError.style.display = "none";
                tdItem.appendChild(titleItem);
                tdItem.appendChild(titleError);
              } else {
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
          }

          var tdEdit = document.createElement("td");
          var tdDelete = document.createElement("td");

          var btnDelete = document.createElement("button");
          var btnEdit = document.createElement("button");

          btnDelete.innerHTML = "delete";
          btnEdit.innerHTML = "edit";

          btnDelete.id = "delete_" + id;
          btnEdit.id = "edit_" + id;

          btnEdit.onclick = function () {
            var id = this.id.match(/\d+/g)[0];
            var title = document.getElementById("title_" + id);
            var text = document.getElementById("text_" + id);

            var isValid = true;

            if (title.value.trim() === "") {
              document.getElementById("title_error_" + id).innerText =
                "Це поле обов'язкове.";
              document.getElementById("title_error_" + id).style.display =
                "block";
              isValid = false;
            } else {
              document.getElementById("title_error_" + id).style.display =
                "none";
            }

            if (text.value.trim() === "") {
              document.getElementById("text_error_" + id).innerText =
                "Це поле обов'язкове.";
              document.getElementById("text_error_" + id).style.display =
                "block";
              isValid = false;
            } else {
              document.getElementById("text_error_" + id).style.display =
                "none";
            }

            if (isValid) {
              AsyncEdit(id, title.value, text.value);
            }
          };

          btnDelete.onclick = function () {
            var id = this.id.match(/\d+/g)[0];
            AsyncDelete(id);
          };

          tdDelete.appendChild(btnDelete);
          tdEdit.appendChild(btnEdit);

          trItem.appendChild(tdEdit);
          trItem.appendChild(tdDelete);
          table.appendChild(trItem);
        });
      }
      CreateNote(table);
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

function AsyncEdit(id, title, text) {
  fetch("async.php", {
    method: "POST",
    body: JSON.stringify({
      action: "edit",
      id: id,
      title: title,
      text: text,
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
