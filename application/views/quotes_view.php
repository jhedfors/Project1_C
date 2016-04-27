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
       <a href="/logout">Logout</a>
     </div>
   </div>
   <div class="row">
     <div class="col s12">
       <h4>Welcome, <?php echo $alias ?>!</h4>
       <div class="row">
         <div class="col s6">
           <p>
             Quotable Quotes
           </p>
           <?php
              foreach ($data['non_favorites'] as $non_favorite) {
                ?>
                <div class="result">
                  <p>
                    <?php echo $non_favorite['speaker'] ?>: <?php echo $non_favorite['quote'] ?>
                  </p>
                  <p>
                    Posted by <?php echo $non_favorite['alias'] ?>
                    <a href="/main/remove_favorite/<?php echo $non_favorite['favorite_id'] ?>/<?php echo
                     $active_id ?>">Remove from List</a>

                    </form>
                  </p>

                </div>

                <?php
              }

            ?>


         </div>
         <div class="col s6">
           <p>
             Your Favorites
           </p>
           <?php
              foreach ($data['favorites'] as $favorite) {
                ?>
                <div class="result">
                  <p>
                    <?php echo $favorite['speaker'] ?>: <?php echo $favorite['quote'] ?>
                  </p>
                  <p>
                    Posted by <?php echo $favorite['alias'] ?>
                    <a href="/main/remove_favorite/<?php echo $favorite['favorite_id'] ?>/<?php echo
                     $active_id ?>">Remove from List</a>

                    </form>
                  </p>

                </div>

                <?php
              }

            ?>
           <p>
             Quotable Quote:
           </p>
           <form action="/main/add" method="post">
             <label for="speaker">Quoted By:</label>
             <input type="text" name="speaker">
             <label for="quote">Message:</label>
             <textarea name="quote"></textarea>
             <input type="hidden" name="active_id" value="<?php echo $active_id ?>">
             <input type="submit" value="Submit">
           </form>

         </div>

       </div>
     </div>
   </div>

              <?php
              var_dump($data);

               ?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

</body>
</html>
