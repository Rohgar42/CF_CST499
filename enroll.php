<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<head>
    <title> Profile Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
//Select current user
include "master.php";
$sql = "SELECT * FROM tbluser WHERE id = :id";
$params = [":id" => $_SESSION["id"]];
try {
    $userResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
}
// echo "<pre>";
// print_r($con);
// print_r($sql);
// print_r($params);
// print_r($userResults);
// echo("<br/>POST:");
// print_r($_POST);
// echo "</pre>";


//Select  year
$sql = "SELECT id, year FROM tblyear ";
$params = [];
try {
    $yrResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
}


//Select  term
$sql = "SELECT id, term FROM tblterm ";
$params = [];
try {
    $trmResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
}

//Add or Enroll course
if ($_POST) {
    if (isset($_POST['courseAction'])) {
        if ($_POST['courseAction'] == 1) {
            // sql for enroll
            $sql = "INSERT INTO tblenrolled (userId, courseId, termId, yearId)
         VALUES (:userId, :courseId, :termId, :yearId);";
            $params = [
                ':userId' => $_SESSION["id"],
                ':courseId' => $_POST['courseId'],
                ':termId' => $_POST['termId'],
                ':yearId' => $_POST['yearId']
            ];

        } elseif ($_POST['courseAction'] == 2) {
            // sql for waitlist...
            $sql = "INSERT INTO tblwaitlist (userId, availCourseId, termId, yearId)
         VALUES (:userId, :courseId, :termId, :yearId);";
            $params = [
                ':userId' => $_SESSION["id"],
                ':courseId' => $_POST['courseId'],
                ':termId' => $_POST['termId'],
                ':yearId' => $_POST['yearId']
            ];
        } elseif ($_POST['courseAction'] == 3) {
            // sql for drop course...
            $sql = "DELETE FROM tblenrolled WHERE id = :enrolledId";
            $params = [':enrolledId' => $_POST['Id']];
        } elseif ($_POST['courseAction'] == 4) {
            // sql remove from waitlist...
            $sql = "DELETE FROM tblwaitlist WHERE id = :waitlistId";
            $params = [':waitlistId' => $_POST['waitlistId']];
        }
        //run sql statement
        try {
            $updateResults = $db->executeQuery($con, $sql, $params);
        } catch (PDOException $e) {
            echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
        }
        // echo "<pre>";
        // print_r($con);
        // print_r($sql);
        // print_r($params);
        // print_r($updateResults);
        // echo "</pre>";
    }
}
//Available Courses
$sql = "SELECT c.id, c.courseName, c.courseDesc, c.courseNomenclature, c.courseMinSize, c.courseMaxSize, c.credits,
                 t.id AS termId, t.term, y.id AS yearId, y.year
            FROM tblcourse c
                LEFT JOIN tblavailablecourses a ON c.id = a.courseId
                LEFT JOIN tblterm t ON t.id = a.termId
                LEFT JOIN tblyear y ON y.id = a.yearId WHERE";
if (isset($_POST)) {
    if ($_POST['term'] != 0 || $_POST['termId'] != 0) {
        $sql .= " a.termId = :termId";
        if (isset($_POST['term'])) {
            $params = array_merge($params, array(':termId' => $_POST['term']));
        } elseif (isset($_POST['termId'])) {
            $params = array_merge($params, array(':termId' => $_POST['termId']));
        }
    }
    if (($_POST['term'] != 0 && $_POST['year'] != 0) || ($_POST['termId'] != 0 && $_POST['yearId'] != 0)) {
        $sql .= " AND";
    }
    if (($_POST['year'] != 0) || ($_POST['yearId'] != 0)) {
        $sql .= " a.yearId = :yearId";
        if (isset($_POST['year']) != 0) {
            $params = array_merge($params, array(':yearId' => $_POST['year']));
        } elseif ($_POST['yearId'] != 0) {
            $params = array_merge($params, array(':yearId' => $_POST['yearId']));
        } else {
            echo("Something went wrong!");
        }
    }
    if ($_POST['term'] != 0 || $_POST['year'] != 0 || $_POST['termId'] != 0 || $_POST['yearId'] != 0) {
        $sql .= " AND";
    }
}
$sql .= " c.id NOT IN (SELECT e.courseId FROM tblenrolled e WHERE e.userId = :userId)
        AND c.id NOT IN (SELECT w.availCourseId FROM tblwaitlist w WHERE w.userId = :userId)";
$sql .= " ORDER BY a.yearId, a.termId";

$params = array_merge($params, array(':userId' => $_SESSION['id']));

// echo("Available Courses:<br/>");
// echo "<pre>";
//print_r($con);
// print_r($sql);
// print_r($params);
//print_r($courseResults);
// echo "</pre>";
// exit(0);
try {
    $courseResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")";
}

for ($i = 0; $i < count($courseResults); $i++) {
    $sql = "SELECT * FROM tblenrolled WHERE courseId = :courseId AND termId = :termId AND yearId = :yearId";
    $params = [
        ':courseId' => $courseResults[$i]['id'],
        ':termId' => $courseResults[$i]['termId'],
        ':yearId' => $courseResults[$i]['yearId']
    ];
    try {
        $result = $db->executeSelectQuery($con, $sql, $params);
        if (sizeof($result) >= $courseResults[$i]['courseMaxSize']) {
            $fullCourse = TRUE;
        } else {
            $fullCourse = FALSE;
        }
    } catch (PDOException $e) {
        $errors[] = "ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")";
        return false;
    }
    if ($fullCourse === TRUE) { // If full add fullCourse flag
        $courseResults[$i]['fullCourse'] = 1;
    } else {
        $courseResults[$i]['fullCourse'] = 0;
    }
}
// echo "<pre>";
// print_r($con);
// print_r($sql);
// print_r($params);
// print_r($courseResults);
// echo "</pre>";


// Enrolled Courses
$sql = "SELECT e.id as enrolledId, e.termId, e.yearId, t.term, y.year, c.*
  FROM tblenrolled e
  LEFT JOIN tblcourse c ON e.courseId = c.Id
  LEFT JOIN tblterm t ON t.id = e.termId
  LEFT JOIN tblyear y ON y.id = e.yearId
  WHERE e.userId = :id";
$params = [":id" => $_SESSION["id"]];
try {
    $enrolledResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
}
// echo "<pre>";
// print_r($con);
// print_r($sql);
// print_r($params);
// print_r($enrolledResults);
// echo "</pre>";


// Waitlist Courses
$sql = "SELECT w.id as waitlistId, w.termId, w.yearId, t.term, y.year, c.*
  FROM tblwaitlist w
  LEFT JOIN tblcourse c ON w.availCourseId = c.id
  LEFT JOIN tblterm t ON t.id = w.termId
  LEFT JOIN tblyear y ON y.id = w.yearId
  WHERE w.userId = :id";
$params = [":id" => $_SESSION["id"]];
// echo("waitList SQL: ". $sql."<br/>");
// echo("<pre>");
// print_r($params);
// echo("</pre><br/>");
try {
    $waitlistResults = $db->executeSelectQuery($con, $sql, $params);
} catch (PDOException $e) {
    echo("ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")");
}
// echo("waitlistResults:<pre>");
// print_r($waitlistResults);
// echo("</pre><br/>");
?>
<div class="container text-center">
    <h1>Welcome to the Enrollment page</h1>
</div>

<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <div class="form-group">
                        <div class="row">
                            <!-- Wait List Courses -->
                            <h4 class=""><b>My Wait List Courses</b></h4>
                            <?php if (sizeof($waitlistResults) == 0) : ?> <!-- CHECK for NO enrolled classes         <============= -->
                              <p class="">No Waitlisted Courses</p>
                            <?php endif; ?>
                            <div class="">
                                <table style="width:100%">
                                    <?php foreach ($waitlistResults as $row)  : ?>
                                            <tr>
                                                <td><?php echo $row['courseNomenclature']; ?></td>
                                                <td><?php echo $row['courseName']; ?></td>
                                                <td><?php echo $row['year']; ?></td>
                                                <td><?php echo $row['term']; ?></td>
                                                <td>
                                                  <form role="form" id="waitlistCourse<?php echo $row['waitlistId']; ?>" action="enroll.php" method="post">
                                                    <input type="hidden" id="waitlistId" name="waitlistId" value="<?php echo $row['waitlistId']; ?>">
                                                    <input type="hidden" id="termId" name="termId" value="<?php echo $row['termId']; ?>">
                                                    <input type="hidden" id="yearId" name="yearId" value="<?php echo $row['yearId']; ?>">
                                                    <input type="hidden" id="courseAction" name="courseAction" value="4">
                                                    <input type="submit" value='Remove'>
                                                  </form>
                                                </td>
                                            </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <div class="row">
                                <!-- My Enrolled Courses                   -->
                                <h4 class=""><b>My Enrolled Courses</b></h4>
                                <?php if (sizeof($enrolledResults) == 0) : ?> <!-- CHECK for NO enrolled classes         <============= -->
                                  <p class="">No Enrolled Courses</p>
                                <?php endif; ?>
                                <div class="">
                                    <table style="width:100%">
                                        <tr>
                                            <div class="">
                                                <table style="width:100%">
                                                    <?php foreach ($enrolledResults as $row)  : ?>
                                                        <tr>
                                                            <td><?php echo $row['courseNomenclature']; ?></td>
                                                            <td><?php echo $row['courseName']; ?></td>
                                                            <td><?php echo $row['year']; ?></td>
                                                            <td><?php echo $row['term']; ?></td>
                                                            <!-- <td>
                                                              <form role="form" id="enrolledCourseDetails<?php //echo $row['enrolledId']; ?>" action="enroll.php" method="post">      <input type="hidden" id="courseAction" name="courseAction" value="5">
                                                                <input type="hidden" id="courseId" name="courseId" value="<?php //echo $row['courseId']; ?>">
                                                                <input type="hidden" id="Id" name="Id" value="<?php //echo $row['enrolledId']; ?>">
                                                                <input type="hidden" id="termId" name="termId" value="<?php // $row['termId']; ?>">
                                                                <input type="hidden" id="yearId" name="yearId" value="<?php //echo $row['yearId']; ?>">
                                                                <input type="submit" value='Details'>
                                                              </form>
                                                            </td> -->
                                                            <td>
                                                              <form role="form" id="enrolledCourseDrop<?php echo $row['enrolledId']; ?>" action="enroll.php" method="post">
                                                                <input type="hidden" id="courseAction" name="courseAction" value="3">
                                                                <input type="hidden" id="courseId" name="courseId" value="<?php echo $row['courseId']; ?>">
                                                                <input type="hidden" id="Id" name="Id" value="<?php echo $row['enrolledId']; ?>">
                                                                <input type="hidden" id="termId" name="termId" value="<?php echo $row['termId']; ?>">
                                                                <input type="hidden" id="yearId" name="yearId" value="<?php echo $row['yearId']; ?>">
                                                                <input type="submit" value='Drop'>
                                                              </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form role="form" id="selTermYr" action="enroll.php" method="post">
                        <div class="text-center">
                          <h4 class=""><b>Available Courses</b></h4>
                        <div class="row">
                            <!-- Select year -->
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="text-left">
                                        <label for="year">Select year:</label>
                                    </div>
                                    <select name="year" id="year" class="form-control input-sm"
                                            onchange="submitForm('selTermYr');">
                                        <option value=0> Select year</option>
                                        <<?php
                                        foreach ($yrResults as $row) {
                                            echo("<option value='" . $row['id'] . "'");
                                            if ($row['id'] == $_POST['yearId'] || $row['id'] == $_POST['year']) {
                                                echo(" selected");
                                            }
                                            echo(">" . $row['year'] . "</option>");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Select term -->
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <div class="text-left">
                                        <label for="term">Select term:</label>
                                    </div>
                                    <select name="term" id="term" class="form-control input-sm"
                                            onchange="submitForm('selTermYr');">
                                        <option value=0> Select term</option>
                                        <<?php
                                        foreach ($trmResults as $row) {
                                            // echo "<option value = '".$row['id']."'>".$row['term']."</option>";
                                            echo("<option value='" . $row['id'] . "'");
                                            if ($row['id'] == $_POST['termId'] || $row['id'] == $_POST['term']) {
                                                echo(" selected");
                                            }
                                            echo(">" . $row['term'] . "</option>");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>



                    <div class="form-group">
                        <div class="text-left">
                            <div class="row">
                                <!-- //Available Courses -->
                                <div class="">
                                    <table style="width:100%">
                                        <?php foreach ($courseResults as $row)  : ?>
                                            <tr>
                                                <td><?php echo $row['courseNomenclature']; ?></td>
                                                <td><?php echo $row['courseName']; ?></td>
                                                <td><?php echo $row['year']; ?></td>
                                                <td><?php echo $row['term']; ?></td>
                                                <form role="form" id="addCourse" action="enroll.php" method="post">
                                                    <?php if ($row['fullCourse'] == 0) : ?> <!-- CHECK IF ROOM IN THE CLASS         <============= -->
                                                        <td><input type="submit" value='Enroll'></td>
                                                        <input type="hidden" id="courseAction" name="courseAction"
                                                               value="1">
                                                    <?php else : ?>
                                                        <td><input type="submit" value='Waitlist'></td>
                                                        <input type="hidden" id="courseAction" name="courseAction"
                                                               value="2">
                                                    <?php endif; ?>
                                                    <input type="hidden" id="courseId" name="courseId"
                                                           value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" id="termId" name="termId"
                                                           value="<?php echo $row['termId']; ?>">
                                                    <input type="hidden" id="yearId" name="yearId"
                                                           value="<?php echo $row['yearId']; ?>">
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
<script type="text/javascript">document.getElementById("Enroll").className = "active";</script>
<script type='text/javascript'>
    function submitForm(id) {
        // Call submit() method on <form id>
        document.getElementById(id).submit();
    }
</script>
</html>
