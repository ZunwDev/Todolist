class Log {
    constructor(projectID, taskID, boardID) {
        this.projectID = projectID;
        this.taskID = taskID;
        this.boardID = boardID;
    }

    logActivity(message, old_val, new_val, typeID) {
        $.post("../utils/scripts/project/logActivity.php", {
            projectID: this.projectID,
            taskID: this.taskID,
            boardID: this.boardID, 
            description: message,
            old_val: old_val,
            new_val: new_val,
            typeID: typeID,
        });
    }

    logNewTask(task_name, column_name) {
        this.logActivity(`Added task „${task_name}” to column „${column_name}”`, null, null, 2);
    }
    logRemoveTask(task_name, column_name) {
        this.logActivity(`Deleted task „${task_name}” from column „${column_name}”`, null, null, 1);
    }
    logClearColumn(column_name) {
        this.logActivity(`Cleared column „${column_name}”`, null, null, 1);
    }
    logRemoveColumn(column_name) {
        this.logActivity(`Deleted column „${column_name}”`, null, null, 1);
    }
}