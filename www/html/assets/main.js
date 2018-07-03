
function addBook() {

    // GRAB INPUT VALUSE
    let title = $('#title').val();
    let author = $('#author').val();
    let publisher = $('#publisher').val();
    let copyright = $('#copyright').val();
    let isbn = $('#isbn').val();
    let pages = $('#pages').val();
    let version = $('#version').val();

    let sendData = {
        "fxn": "addBook", "data": [title, author, publisher, copyright, isbn, pages, version]
    };

    $.ajax({
        url: "/inc/books.handler.php",
        type: 'POST',
        data: sendData,
        dataType: 'json', // going to draw the table as html
        success: function (data, textStatus, jqXHR) {

            // redirect to content list page
           alert('Book Entered');

        },
        complete: function (xhr, textStatus) {

        },
        error: function (xhr, textStatus, text) {
            alert("error");

        }
    });
}

/** 
 *
 * /////////////////////////
 *
 *        DATA TABLES
 *
 * ////////////////////////
 *
 * */
function bookList() {
    let sendData = { "fxn": "getBookTable" };

    $.ajax({
        url: "/inc/books.handler.php",
        type: 'POST',
        data: sendData,
        dataType: 'json', // going to draw the table as html
        success: function (data, textStatus, jqXHR) {

            let table = $('#bookList').DataTable({
                rowId: 'id',
                data: data,
                "order": [[3, "desc"]], // ordered by time / date
                columns: [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "author" },
                    { "data": "publisher" },
                    { "data": "copyright" },
                    { "data": "isbn" },
                    { "data": "pages" },
                    { "data": "versions" }
                ]

            });

            table.columns.adjust().draw();
            table.columns.adjust();

        },
        complete: function (xhr, textStatus) {


        },
        error: function (xhr, textStatus, text) {
            toastr.error("error");

        }
    });
}