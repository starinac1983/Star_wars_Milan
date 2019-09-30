<?php
// this code below is what can be stored in require_once "RESTful.php"
function curl_get($url) {
  $client = curl_init($url);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
return $response;
}

// array of favourite chars, loop through it to perform search request api and get the data in $char_list array
$favs = ['Leia', 'Luke', 'Han', 'Binks', 'R2', 'Qui-Gon'];
$char_list = [];
foreach ($favs as $value){ 
  $url = "https://swapi.co/api/people/?search=$value";
  $response = curl_get($url);
  $row = json_decode($response);

  $char_list[] = [
    'name' => $row->results[0]->name,
    'height' => $row->results[0]->height,
    'gender' => $row->results[0]->gender
  ];
}
$json_char_list = json_encode($char_list);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>StarWars Heroes></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Maven+Pro:700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  
  <body>
<header>
  StarWars Heroes
</header>

<!-- page content -->
    <div class="container-fluid">
      <div class="row m-4" id="output">


<script>
  var char_list = <?php echo $json_char_list; ?>;
  for (i = 0; i < char_list.length; i ++) {
    document.getElementById('output').innerHTML += 
        `<div class="col-md-6 col-lg-4 mb-3">
          <div class="content col-12 rounded shadow text-dark pt-3 pb-3 card">
            <img class="img-thumbnail img-fluid d-none d-md-block" src="img/star-wars-image.jpg" alt="image" >
            <p class="text-dark font-weight-bold mt-1">Name: ${char_list[i].name} </p>
            <p class="font-weight-lighter small font-italic">Height: ${char_list[i].height}</p>
            <p class="mt-3 mb-0">Gender: ${char_list[i].gender}</p>
          </div>
        </div>`
  }
</script>

      </div>
    </div>
    
  </body>
</html>