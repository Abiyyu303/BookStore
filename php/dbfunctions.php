<?php
function dbconnect()
{
    $conn = mysqli_connect("localhost", "root", "", "bookstore_db");
    if (!$conn) {
        echo "Can't connect database " . mysqli_connect_error($conn);
        exit;
    }
    return $conn;
}

function latestBook($conn)
{
    $row = array();
    $query = "SELECT book_isbn, book_image, book_title FROM books ORDER BY abs(unix_timestamp(created_at)) DESC";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for ($i = 0; $i < 6; $i++) {
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}

function getBook($conn, $isbn)
{
    $query = "SELECT * FROM books WHERE book_isbn = '$isbn'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    return mysqli_fetch_assoc($result);
}

function getBookByIsbn($conn, $isbn){
    $query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    return $result;
}

function getbookprice($isbn){
    $conn = dbconnect();
    $query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "get book price failed! " . mysqli_error($conn);
        exit;
    }
    $row = mysqli_fetch_assoc($result);
    return $row['book_price'];
}

?>