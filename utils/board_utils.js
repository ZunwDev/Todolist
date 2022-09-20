function addBoard() {
    var findProjectID = document.querySelectorAll(`section[id$='_id']`);
    var projectID = findProjectID[0].id.slice(0, findProjectID[0].id.indexOf("_"));
    
     $.post("../utils/scripts/addNewBoard.php", {
        projectID: projectID,
        board_name: "Column",
        board_description: ""
    }).done(function(data) {
        console.log(data);
    })
}