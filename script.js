function attachTaskEvents(div) {
  const li = div.querySelector("li");
  const checkbox = div.querySelector(".checkbox");
  const remove = div.querySelector(".remove");

  checkbox.addEventListener("click", function () {
    const taskId = checkbox.getAttribute("data-task-id");
    const isDone = checkbox.checked ? 1 : 0;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "tasks.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log("Task status updated successfully.");
        if (isDone) {
          li.classList.add("crossed-out");
        } else {
          li.classList.remove("crossed-out");
        }
      }
    };
    xhr.send("update_done=1&task_id=" + taskId + "&is_done=" + isDone);
  });

  remove.addEventListener("click", function () {
    const form = remove.closest("form");
    form.submit();
  });
}

document.querySelectorAll(".checkboxAndli").forEach(function (div) {
  attachTaskEvents(div);
});

const add = document.getElementById("add");
const input = document.getElementById("taskInput");
const tasklist = document.getElementById("tasklist");

function clearInput() {
  input.value = "";
}

document
  .getElementById("taskForm")
  .addEventListener("submit", function (event) {
    if (input.value === "") {
      event.preventDefault();
      const nice = document.createElement("p");
      nice.innerText = "nothing to do...nice";
      document.getElementById("inputandbtn").appendChild(nice);
      return;
    }
  });
