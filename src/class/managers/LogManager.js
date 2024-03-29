class LogManager {
  constructor(projectID, taskID, boardID) {
    this.projectID = projectID;
    this.taskID = taskID;
    this.boardID = boardID;
  }

  logActivity(message, old_val, new_val, typeID) {
    $.post("https://xtodolist.tode.cz/src/scripts/project/logActivity.php", {
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
  logTaskMove(column_name, new_column_name, task_name) {
    this.logActivity(
      `Moved task „${task_name}” from column „${column_name}” to column „${new_column_name}”`,
      column_name,
      new_column_name,
      4
    );
  }
  logClearColumn(column_name) {
    this.logActivity(`Cleared column „${column_name}”`, null, null, 1);
  }
  logRemoveColumn(column_name) {
    this.logActivity(`Deleted column „${column_name}”`, null, null, 1);
  }
  logTaskUpdate(task_name, column_name, new_val) {
    this.logActivity(`Updated task „${task_name}” in column „${column_name}”`, task_name, new_val, 3);
  }
  logColumnUpdate(column_name, new_val) {
    this.logActivity(`Updated column „${column_name}”`, column_name, new_val, 3);
  }
  logNewColumn(column_name) {
    this.logActivity(`Added column „${column_name}”`, null, null, 2);
  }
}
