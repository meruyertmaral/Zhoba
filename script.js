document.addEventListener("DOMContentLoaded", () => {
    const taskForm = document.getElementById("taskForm");
    const taskList = document.getElementById("taskList");

    taskForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const taskName = document.getElementById("taskName").value;
        const deadline = document.getElementById("deadline").value;

        if (taskName && deadline) {
            const task = document.createElement("div");
            task.classList.add("task");

            const taskDetails = document.createElement("div");
            taskDetails.classList.add("task-details");

            const taskNameElem = document.createElement("span");
            taskNameElem.classList.add("task-name");
            taskNameElem.textContent = taskName;

            const deadlineElem = document.createElement("span");
            deadlineElem.classList.add("task-deadline");
            deadlineElem.textContent = `Deadline: ${deadline}`;

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.classList.add("delete-button");
            deleteButton.addEventListener("click", () => {
                task.remove();
            });

            taskDetails.appendChild(taskNameElem);
            taskDetails.appendChild(deadlineElem);

            task.appendChild(taskDetails);
            task.appendChild(deleteButton);

            taskList.appendChild(task);

            taskForm.reset();
        }
    });
});
