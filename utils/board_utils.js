function addBoard() {
    var findProjectID = document.querySelectorAll(`section[id$='_id']`);
    var projectID = findProjectID[0].id.slice(0, findProjectID[0].id.indexOf("_"));

    $.post("../utils/scripts/addNewBoard.php", {
        projectID: projectID,
        board_name: "Column",
        board_description: ""
    }).done(function (data) {
        console.log(data);
    })
}

function addNewTask(boardName) {
    var board = document.getElementById(boardName + "_name");
    var existingTasks = document.querySelectorAll(`[class*='board_']`);
    board.insertAdjacentHTML("beforeend",
        `<div class="board_${existingTasks.length + 1} w-full h-8 mt-0.5 bg-slate-200 flex-row">
            <textarea class="task flex form-control h-full resize-none bg-transparent overflow-y-hidden pt-1 pl-2 w-full focus:text-gray-700 focus:bg-white focus:border focus:outline-none focus:border-blue-600">Task #${existingTasks.length + 1}</textarea>
        </div>
    `)
    let input = document.getElementsByClassName('task');
    setTimeout(function () {
        input[input.length - 1].focus();
        input[input.length - 1].select();
    }, 0);
}