<?php
// CHECKING IF USER EXISTS IN DB, Krossing ca fr 1:10:00
 function uidExists($conn, $username, $email) {
     $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail =?;";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../login.php?error=userExists");
    exit();
     }

     mysqli_stmt_bind_param($stmt, "ss", $username); // "ss" pga 2st strings
     mysqli_stmt_execute($stmt);

     $resultData = mysqli_stmt_get_result($stmt);

     if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
     }
     else {
         $result = false;
         return $result;
     }

     mysqli_stmt_close($stmt);
 }

 function createUser($conn, $name, $username, $email, $pwd) {
     $sql = "INSERT INTO users (alla columns exkl id) VALUES (?, ?, ?, ?)"; // 1st ? per value, alltså name email etc, ? är placeholders
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../login.php?error=stmtfailure");
    exit();
     }

     $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

     mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("location: ../login.php?error=none");  //<-- länka direkt till index istället?
    exit();

 }
