
/**
 * Created by doug on 11/16/16.
 */

window.onload = function() {

    var dayDiv = document.getElementById("addNew")
    var newTaskCol = document.getElementById("newTaskCol")

    dayDiv.onclick = function () {
        if (newTaskCol.style.display !== 'none') {
            newTaskCol.style.display = 'none';
        } else {
            newTaskCol.style.display = 'block';
        }
    };
};