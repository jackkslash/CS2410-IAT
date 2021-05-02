/**
 * Sorts table by animal type, only shows type selected in drop down filter
 * 
 */

function dropDownFilter() {
    //dropdown element
    const dropDownFilterInput = document.getElementById("dropdown-search");

    // store array of all rows
    const rows = document.querySelectorAll("tbody tr");
    console.log(rows);

    // click event to dropdown element
    dropDownFilterInput.addEventListener("click", function () {
        // if the selected dropdown value is empty then show all rows
        if (dropDownFilterInput.value == "") {
            rows.forEach((row) => {
                row.style.display = "table-row"
            });
            return;
        }
        // for each of rows 
        //get columns, check value of second column 
        //"cols[2]" where animal type stored
        // if animal type is same as selected animal type, then show row, otherwise dont
        rows.forEach((row) => {
            var cols = row.querySelectorAll("td");
            cols[2].textContent == dropDownFilterInput.value ?
                (row.style.display = "table-row") :
                (row.style.display = "none");
        });
    });
}

// check if there is a search element before running the above function
var dropDownFilterElement = document.getElementById("dropdown-search");
if (dropDownFilterElement != null) {
    dropDownFilter();
}


/**
 * Sorts a HTML table.
 * 
 * @param {HTMLTableElement} table The table to sort
 * @param {number} column The index of the column to sort
 * @param {boolean} asc Determines if the sorting will be in ascending
 */
function sortTableByColumn(table, column, asc = true) {
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Sort seprate rows
    const sortedRows = rows.sort((a, b) => {
        const colText1 = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const colText2 = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        return colText1 > colText2 ? (1 * dirModifier) : (-1 * dirModifier);
    });

    // Removes existing TRs from table
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    // Re-add new sorted rows
    tBody.append(...sortedRows);

    // Remember how column currently sorted
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
}

//adds event listener for the click on the heading of each col
document.querySelectorAll(".table-sortable th").forEach(headerCell => {
    headerCell.addEventListener("click", () => {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
    });
});
