<!DOCTYPE html>
    
<?php

$keysArray= ["HEADER"=>"", "SUBMIT_BUTTON"=>"", "NEXT_BUTTON"=>"", "FORM_INTRO"=>""];

// function to translate JSON strings
function translate($json, $key) {
    
    // if key doesn't exist fallback to english language file
    if (is_null($json->$key)) {
        $json = json_decode(file_get_contents("languages/english.json"));
        return $json->$key;
    }
    else {
        return $json->$key;
    }
    
}

// check if a file was uploaded:
if(isset($_FILES["file"])){
    
    // convert JSON file to readable object
    $string = file_get_contents($_FILES["file"]["tmp_name"]);
    $json = json_decode($string);
    
    // validate uploaded JSON
    if (is_null($json))
    {
        echo('Invalid JSON file selected.');
    }
    
    // Iterate over each of our keys and translate
    foreach($keysArray as $key=>$value) {
        $value = translate($json, $key);
        $keysArray[$key] = $value;
    }

    //var_dump($keysArray);
}

?>

<html>
<head>
    <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
</head>

<body>
    
    <h1>Please choose a JSON file to translate</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div>
      <label for="file">Choose file to upload</label>
      <input type="file" id="file" name="file" accept="application/json">
    </div>
    <div>
      <button>Submit</button>
    </div>
   </form>
    
    <h1>Translated Values</h1>
    <table>
        <tr>
          <td>Header</td>
          <td id="headerVal" name="HEADER"><?= $keysArray["HEADER"] ?></td>
        </tr>
        <tr>
          <td>Submit Button</td>
          <td id="submitVal" name="SUBMIT_BUTTON"><?= $keysArray["SUBMIT_BUTTON"] ?></td>
        </tr>
        <tr>
          <td>Next Button</td>
          <td id="nextVal" name="NEXT_BUTTON"><?= $keysArray["NEXT_BUTTON"] ?></td>
        </tr>
        <tr>
          <td>Form Intro</td>
          <td id="introVal" name="FORM_INTRO"><?= $keysArray["FORM_INTRO"] ?></td>
        </tr>
    </table>
    
</body>

<footer></footer>
</html>
