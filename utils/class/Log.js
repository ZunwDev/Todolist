class Log {
    constructor(projectID, taskID, boardID) {
        this.projectID = projectID;
        this.taskID = taskID;
        this.boardID = boardID;
    }

    logNewTask(task_name, column_name) {
        $.post("../utils/scripts/project/logActivity.php", {
            projectID: this.projectID,
            taskID: null,
            boardID: this.boardID, 
            description: `Added task „${task_name}” to column „${column_name}”`,
            old_val: null,
            new_val: null,
            typeID: 2,
        });
    }
    logRemoveTask(task_name, column_name) {
        $.post("../utils/scripts/project/logActivity.php", {
            projectID: this.projectID,
            taskID: this.taskID,
            boardID: this.boardID, 
            description: `Deleted task „${task_name}” from column „${column_name}”`,
            old_val: null,
            new_val: null,
            typeID: 1,
        });
    }
}