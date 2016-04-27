<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Quotes</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    $alias = $this->session->userdata('alias');
    $active_id = $this->session->userdata('active_id');
   ?>

   <div class="row">
     <div class="col s12">
       <a href="/quotes">Dashboard</a> | <a href="/logout">Logout</a>
     </div>
   </div>
   <div class="row">
     <div class="col s12">
       <p><?php echo $data[0]['alias'] ?></p>
       <p>Count: <?php echo count($data) ?></p><br>
       <?php
          foreach ($data as $quote) {
      ?>
          <p>
            <span = class='errors'><?php echo $quote['speaker'];?>: </span><?php echo $quote['quote'] ?>
          </p>


      <?php
          }

        ?>
       </div>
     </div>
   </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

</body>
</html>
