<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <title>Hello, world!</title>
    
  </head>
  <body>
   <!-- Button trigger modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/piyush/" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
<div class="form-group">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" class="form-control" name="fnameedit" id="fnameedit" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" name="lnameedit" id="lnameedit" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="emailedit" name="emailedit" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
 
  <!-- <button type="Update" class="btn btn-primary">Submit</button> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>

    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      
    </ul>
   
  </div>
</nav>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
// $sql = "CREATE TABLE MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// if ($conn->query($sql) === TRUE) {
//   echo "Table MyGuests created successfully";
// } else {
//   echo "Error creating table: " . $conn->error;
// }


// $sql="INSERT INTO `myguests` (`firstname`, `lastname`, `email` ) VALUES ('Chandan2', 'Maurya', 'chandan2maurya203@gmail.com')";
// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }
?>
<?php
if(isset($_GET['delete']))
{
  $sno=$_GET['delete'];
  $sql = " DELETE FROM `myguests` WHERE `myguests`.`id` = $sno;";

if ($conn->query($sql) === TRUE) {
  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your notes is deleted successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  echo "Error deleting record: " . $conn->error;
}
 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if(isset($_POST['snoEdit']))
  {
    $fname = $_POST['fnameedit'];
   $lname = $_POST['lnameedit'];
   $email = $_POST['emailedit'];
   $no=$_POST['snoEdit'];
   $sql = "UPDATE `myguests` SET `firstname` = '$fname', `lastname` = ' $lname', `email` = '$email' WHERE `myguests`.`id` = $no";

if ($conn->query($sql) === TRUE) {
  echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your form is edited successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
} else {
  echo "Error updating record: " . $conn->error;
}
  }
  else
   {
    $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];

   // Establish a database connection
  

   // Prepare and execute the SQL query using prepared statements
   $stmt = $conn->prepare("INSERT INTO myguests (firstname, lastname, email) VALUES (?, ?, ?)");
   $stmt->bind_param("sss", $fname, $lname, $email);

   if ($stmt->execute()) {
      echo '<div class="alert  alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your form is submitted successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
   } else {
      echo "Error: " . $stmt->error;
   }
  }
   // Close the database connection
   
}
?>
<div class="container">
<div class="container my-3">
    <h2>Add information Here</h2>
<form action="/piyush/" method="post">
<div class="form-group">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" class="form-control" name="fname" id="fname" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" name="lname" id="lname" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
 
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

<table class="table" id="myTable">
<thead>
  <tr>
    <th scope="col">Id</th>
    <th scope="col">First</th>
    <th scope="col">Last</th>
    <th scope="col">Email</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  <?php
  $sql = "SELECT id, firstname, lastname,email FROM MyGuests";
  $result = $conn->query($sql);
  
  
  if ($result->num_rows > 0) {
    // output data of each row
    $no=0;
    while($row = $result->fetch_assoc()) {
      $no=$no +1;
      echo '
      <tr>
    <th scope="row">'.$no.'</th>
    <td>'. $row["firstname"].'</td>
    <td>'. $row["lastname"].'</td>
    <td>'. $row["email"].'</td>
    <td><button type="button" id='.$row["id"].' class="edit btn btn-primary" data-toggle="modal" data-target="#editleModal">Edit</button> <button type="button" id=d'.$row["id"].' class="delete btn btn-primary" >Delete</button></td>
    
  </tr>
     ';
    }
  } else {
    echo "0 results";
  }
  
  
  $conn->close();
  ?>
  
  
</tbody>

</table>

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
      
    </script>
    <script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
      </script>

<script>
    edits=document.getElementsByClassName("edit");
    Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        // console.log("edit ",e.target.parentNode.parentNode);
        tr=e.target.parentNode.parentNode;
        fname=tr.getElementsByTagName("td")[0].innerText
        lname=tr.getElementsByTagName("td")[1].innerText
        email=tr.getElementsByTagName("td")[2].innerText
        fnameedit.value=fname;
        lnameedit.value=lname;
        emailedit.value=email;
        snoEdit.value=e.target.id
        console.log(e.target.id)
//         $('#editt').on('click',function(){
//       $('#editModal').modal('toggle');
//  });
        // $('#editModal').modal('toggle');
        console.log(fname," ",lname," ",email);
      })
    });

    deletes=document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        // console.log("edit ",e.target.parentNode.parentNode);
       if(confirm("Press a button!"))
       {
        sno=e.target.id.substr(1,);
        window.location=`/piyush/index.php?delete=${sno}`;
        console.log("Yes")
       }else{
        console.log("NO")
       }
      })
    });
      </script>
  </body>
</html>
