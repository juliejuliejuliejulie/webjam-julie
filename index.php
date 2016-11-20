<html>
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Bitter:400,700|Noto+Sans:700" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
  </head>

  <body>
    <h1 class="insulte"> TU VEUX TE BATTRE ?</h1>
    <?php
      $insultes=json_decode(file_get_contents('insultes.json'));
      //var_dump($names);
    ?>
    <form>
        <input class="insulte" type="text" name="insulte" placeholder="Insulte-moi fort">
    </form>
    <?php
      if(isset($_GET['insulte'])){
        $content=$_GET['insulte'];
        $insert = new insert();
        $insert->name=$content;
        array_push($insultes,$insert);

        $index= rand(0,count($insultes));
        echo('<p class="insulte">'.$insultes[$index]->name.'</p>');
      }
    ?>

    <h1 class="gentillesse"> FREE HUGS</h1>
    <form>
        <input class="gentillesse" type="text" name="gentillesse" placeholder="Ecrivez une gentillesse">
    </form>

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
