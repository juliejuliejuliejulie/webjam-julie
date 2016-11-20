<html>
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700|Noto+Sans:700" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="index.css">
  </head>

<?php
    if(isset($_GET['insulte'])){
        echo('<body class="insulte">');
    }
    else if(isset($_GET['gentillesse'])){
        echo('<body class="gentillesse">');
    }
    else{
        echo('<body class="question">');
    }
    
    
    ?>
    
   <section class="insulte question">
    <h1 class="insulte"> TU VEUX TE BATTRE ?</h1>
    <?php
      $insultes=json_decode(file_get_contents('insultes.json'));
      //var_dump($names);
    ?>
    <form>
        <input class="insulte" type="text" name="insulte" placeholder="Fais moi mal Johnny">
    </form>
    </section>
<section class="gentillesse question">
    <h1 class="gentillesse"> TU VEUX <br>UN CALIN ?</h1>
     <?php
      $gentillesses=json_decode(file_get_contents('gentillesses.json'));
      //var_dump($names);
    ?>
    <form>
        <input class="gentillesse" type="text" name="gentillesse" placeholder="Mots doux">
    </form>
    </section>
    <section class="reponse">
         <?php
      if(isset($_GET['gentillesse'])){
        $content=$_GET['gentillesse'];
        $insert = new insert();
        $insert->name=$content;
        array_push($gentillesses,$insert);

        $index= rand(0,count($gentillesses));
        echo('<p class="gentillesse">'.$gentillesses[$index]->name.'</p><i class="fa fa-heart" aria-hidden="true"></i>');
      }
      if(isset($_GET['insulte'])){
        $content=$_GET['insulte'];
        $insert = new insert();
        $insert->name=$content;
        array_push($insultes,$insert);

        $index= rand(0,count($insultes));
        echo('<p class="insulte">'.$insultes[$index]->name.'</p><i class="fa fa-bolt" aria-hidden="true"></i>');
      }
    ?>
    </section>
    <?php
      class insert {
          public function __construct(array $arguments = array()) {
              if (!empty($arguments)) {
                  foreach ($arguments as $property => $argument) {
                      $this->{$property} = $argument;
                  }
              }
          }
          public function __call($method, $arguments) {
              $arguments = array_merge(array("stdObject" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).

              if (isset($this->{$method}) && is_callable($this->{$method})) {
                  return call_user_func_array($this->{$method}, $arguments);
              } else {
                  throw new Exception("Fatal error: Call to undefined method match::{$method}()");
              }
          }
      }
    ?>
  </body>
</html>
