var sort = 0;

function insert() {
  $(document.ready).ready(function() {
    var phpFile = "insert.php";
    if (sort == 1) {
      phpFile = "insertByName.php";
    }
    if (sort == 2) {
      phpFile = "insertByEmail.php";
    }
    if (sort == 3) {
      phpFile = "insertByCompleted.php";
    }
    $.post(phpFile, {}, function(data, status) {
      data = JSON.parse(data);

      var current_page = 1;
      var records_per_page = 3;

      $("#btn_prev").click(function() {
        if (current_page > 1) {
          current_page--;
          changePage(current_page);
        }
      });

      function nextPage() {
        if (current_page < numPages()) {
          current_page++;
          changePage(current_page);
        }
      }
      $("#btn_next").click(function() {
        if (current_page < numPages()) {
          current_page++;
          changePage(current_page);
        }
      });

      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("listingTable");
        var page_span = document.getElementById("page");

        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();
        $("#taskTable").empty();

        for (
          var i = (page - 1) * records_per_page;
          i < page * records_per_page && i < data.length;
          i++
        ) {
          var tr = document.createElement("tr");
          tr.setAttribute("id", i + "tr");
          document.getElementById("taskTable").appendChild(tr);

          var td = document.createElement("td");
          td.setAttribute("id", i + "td");
          document.getElementById(i + "tr").appendChild(td);
          document.getElementById(i + "td").innerHTML = data[i].name;

          var td1 = document.createElement("td");
          td1.setAttribute("id", i + "td1");
          document.getElementById(i + "tr").appendChild(td1);
          document.getElementById(i + "td1").innerHTML = data[i].email;

          var td2 = document.createElement("td");
          td2.setAttribute("id", i + "td2");
          document.getElementById(i + "tr").appendChild(td2);

          var update = document.createElement("textarea");
          update.setAttribute("class", "update");
          update.setAttribute("id", i + "update");
          document.getElementById(i + "td2").appendChild(update);
          update.name = data[i].id;
          update.value = data[i].task;

          var td3 = document.createElement("td");
          td3.setAttribute("id", i + "td3");
          document.getElementById(i + "tr").appendChild(td3);

          var done = document.createElement("input");
          done.type = "checkbox";

          if (data[i].completed == "true") {
            done.checked = true;
          } else {
            done.checked = false;
          }
          done.setAttribute("class", "done");
          done.setAttribute("id", i + "done");
          document.getElementById(i + "td3").appendChild(done);

          var td4 = document.createElement("td");
          td4.setAttribute("id", i + "td4");
          document.getElementById(i + "tr").appendChild(td4);

          var up = document.createElement("button");
          up.setAttribute("class", "btn btn-info btn-update");
          up.setAttribute("id", i + "but");
          document.getElementById(i + "td4").appendChild(up);
          document.getElementById(i + "but").onclick = updateTask;
        }
        page_span.innerHTML = page + "/" + numPages();

        if (page == 1) {
          btn_prev.style.visibility = "hidden";
        } else {
          btn_prev.style.visibility = "visible";
        }

        if (page == numPages()) {
          btn_next.style.visibility = "hidden";
        } else {
          btn_next.style.visibility = "visible";
        }
      }

      function numPages() {
        return Math.ceil(data.length / records_per_page);
      }

      changePage(1);
    });
  });
}

insert();

var updateTask = function() {
  var numb = document.getElementById(this.id.substring(0, 1).concat("update"))
    .name;
  var change = document.getElementById(this.id.substring(0, 1).concat("update"))
    .value;
  var completed = document
    .getElementById(this.id.substring(0, 1).concat("done"))
    .checked.toString();

  $(document.ready).ready(function() {
    $.post(
      "update.php",
      {
        numb: numb,
        change: change,
        completed: completed
      },
      function(data, status) {
        insert();
      }
    );
  });
};

function sortByName() {
  sort = 1;
  insert();
}

function sortByEmail() {
  sort = 2;
  insert();
}

function sortByCompleted() {
  sort = 3;
  insert();
}

function logout() {
  window.location.href = "logout.php";
}

document.getElementById("sortName").addEventListener("click", sortByName);
document.getElementById("sortEmail").addEventListener("click", sortByEmail);
document
  .getElementById("sortCompleted")
  .addEventListener("click", sortByCompleted);
document.getElementById("login").addEventListener("click", logout);
