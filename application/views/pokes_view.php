<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Pokes</title>

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
       <a href="/logout">Logout</a>
     </div>
   </div>
   <div class="row">
     <div class="col s12">
       <h4>Welcome, <?php echo $alias ?>!</h4>
       <p>
         <?php echo count($data['pokes']);
       ?> people poked you!
       </p>
       <div class="poked_by">
         <?php
         foreach ($data['pokes'] as $poke) {
           if ($poke['pokee_id'] == $active_id) {
          ?>
          <p>
            <?php echo $poke['poker_name']  ?> poked you <?php echo $poke['count'] ?> times
          </p>
            <?php
            }
          }
            ?>
       </div>
       <div class="row">
         <div class="col s12">
           <p>
             People you may want to poke:
           </p>
           <table>
             <thead>
               <tr>
                 <th>Name</th>
                 <th>Alias</th>
                 <th>Email Address</th>
                 <th>Poke History</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             <?php
                foreach ($data['all_users'] as $user) {
                  if ($user['id'] != $active_id) {
             ?>
                <tr>
                  <td><?php echo $user['name'] ?></td>
                  <td><?php echo $user['alias'] ?></td>
                  <td><?php echo $user['email'] ?></td>
                  <td><?php if ($user['pokes_recieved']) {
                    echo $user['pokes_recieved'];
                  } else {
                    echo 0;
                  } ?> pokes</td>
                  <td><a href="/poke/<?php echo $user['id'] ?>/<?php echo $active_id ?>">Poke</a>
                    </td>
                </tr>

              <?php
                  }
                }

              ?>
             </tbody>
           </table>

         </div>

       </div>
     </div>
   </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

</body>
</html>
