<?php
  class user {
    private $username;
    private $password;
    private $email;
    private $score;

    public function get_username() {
      return $this->username;
    }

    public function get_password() {
      return $this->password;
    }

    public function get_email() {
      return $this->email;
    }

    public function get_score() {
      return $this->score;
    }

    public function __construct($a,$b,$c) {
      $this->username=$a;
      $this->password=$b;
      $this->email=$c;
    }

  }

  $h = 'localhost';
  $db   = 'jeux';
  $username = 'root';
  $password = '';
  $charset = 'utf8';

  $dsn = "mysql:host=$h;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
      $_DB = new PDO($dsn, $username, $password, $options);
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  try{
    $request = $_DB->prepare('SELECT * FROM user');
    $request->execute();
    $data=$request->fetchALL();
  } catch (PDOException $e) {
    print "Error!: ".$e->getMessage(). "<br/>";
    die();
  }

  function check_email($method,$prop) {
    $method[$prop]=filter_var($method[$prop], FILTER_SANITIZE_EMAIL);
    if (filter_var($method[$prop], FILTER_VALIDATE_EMAIL)) {
      return true;
    }
    return false;
  }

  function check_input($input,$value,$min_lenght,$max_lenght) {
    if (strlen($input[$value])>=$min_lenght && strlen($input[$value])<=$max_lenght) {
      return true;
    }
    return false;
  }

  function connexion(){
    if(isset($_SESSION['username'])){
      return true;
    }
    return false;
  }

  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['connexion'])) {
      if ($_POST['username']!='' && $_POST['password']!='') {
        try{
          $request = $_DB->prepare('SELECT * FROM user');
          $request->execute();
          while ($data=$request->fetch()) {
            if ($data['username']==$_POST['username'] && $data['password']==$_POST['password']) {
              $_SESSION['username']=$_POST['username'];
            }
          }
        } catch (PDOException $e) {
          print "Error!: ".$e->getMessage(). "<br/>";
          die();
        }
        if (!isset($_SESSION['username'])) {
          $error1="<li>Vos identifiants sont erronnés!</li>";
        }
      } else {
        if ($_POST['username']=='') {
          $error2 = "<li>Quel est votre nom d'utilisateur?</li>";
        }
        if ($_POST['password']=='') {
          if (isset($error2)){
            $error2 .= "<li>Quel est votre mot de passe?</li>";
          } else {
            $error2 = "<li>Quel est votre mot de passe?</li>";
          }
        }
      }
    }
    if (isset($error1)) {
      echo '<ul class="event">'.$error1.'</ul>';
    }
    if (isset($error2)) {
      echo '<ul class="event">'.$error2.'</ul>';
    }
    if (isset($_POST['inscription'])) {
      if (isset($_POST['new_username']) && isset($_POST['new_password1']) && isset($_POST['new_password2']) && isset($_POST['email'])) {
        if ($_POST['new_password1']==$_POST['new_password2']) {
          if (check_input($_POST, 'new_username',5,255) && check_input($_POST, 'new_password1',5,255)) {
            try{
              $nouveau = new user($_POST['new_username'],$_POST['new_password1'],$_POST['email']);
              $send = $_DB->prepare('INSERT  INTO user (username, password, email) VALUES (:username, :password, :email)');
              $send->execute(array('username'=>$nouveau->get_username(), 'password'=>$nouveau->get_password(), 'email'=>$nouveau->get_email()));
              echo '<p class="event">Vous pouvez à présent vous connecter!</p>';
            } catch (PDOException $e) {
              print "Error!: ".$e->getMessage(). "<br/>";
              die();
            }
          } else {
            if (!check_input($_POST, 'new_username', 5, 255)) {
              $error3 = "<li>Votre nom d'utilisateur doit contenir entre 5 et 255 caractères.</li>";
            }
            if (!check_input($_POST, 'email', 5, 255)) {
              if (isset($error3)){
                $error3 .= "<li>Votre adresse e-mail ne doit pas excéder 255 caractères.</li>";
              } else {
                $error3 = "<li>Votre adresse e-mail ne doit pas excéder 255 caractères.</li>";
              }
            }
            if (check_input($_POST, 'email', 5, 255) && !check_email($_POST, 'email')) {
              if (isset($error3)){
                $error3 .= "<li>Votre adresse e-mail n'est pas correcte!</li>";
              } else {
                $error3 = "<li>Votre adresse e-mail n'est pas correcte!</li>";
              }
            }
            if ($_POST['new_password1']=='' && $_POST['new_password2']=='') {
              if (isset($error3)){
                $error3 .= "<li>N'oubliez pas d'entrer et de confirmer votre mot de passe!</li>";
              } else {
                $error3 = "<li>N'oubliez pas d'entrer et de confirmer votre mot de passe!</li>";
              }
            }
          }
        } elseif ($_POST['new_password1']!='' && $_POST['new_password2']=='') {
            if (isset($error3)){
              $error3 .= "<li>N'oubliez pas de confirmer votre mot de passe!</li>";
            } else {
              $error3 = "<li>N'oubliez pas de confirmer votre mot de passe!</li>";
            }
          } elseif ($_POST['new_password1']=='' && $_POST['new_password2']!='') {
            if (isset($error3)){
              $error3 .= "<li>N'oubliez pas d'entrer votre mot de passe et de le confirmer!</li>";
            } else {
              $error3 = "<li>N'oubliez pas d'entrer votre mot de passe et de le confirmer</li>";
            }
          } else {
            $error3 = "<li>Vous avez entré deux mots de passe différents</li>";
          }
        }
      }
    if (isset($error3)) {
      echo '<ul class="event">'.$error3.'</ul>';
    }
  }
  if (!isset($_SESSION['username']) || isset($error1) || isset($error2) || isset($error3)) {
?>
<nav>
  <div>
    <input id='log' type="button" value="Se connecter"/><input id='subscribe' type="button" value='S&#39;inscrire'/>
  </div>
  <ul>
    <li id="connexion">
      <form method="POST" action="index.php" class="connexion">
        <fieldset>
          <legend>Connexion</legend>
          <label for="login">Login: </label>
          <input name="username" id="login" placeholder="Nom d'utilisateur" type=text/></br>
          <label for="password">Mot de passe: </label>
          <input name="password" id="password" placeholder="Mot de passe" type="password"/></br>
          <input type="submit" name="connexion" value="Se connecter"/>
        </fieldset>
      </form>
    </li>
    <li id="inscription">
      <form method="POST" action="index.php" class="inscription">
        <fieldset>
          <legend>Inscripiton</legend>
          <label for="email">Adresse e-mail: </label>
          <input name="email" id="email" placeholder="email" type="email"/></br>
          <label for="login">Login: </label>
          <input name="new_username" id="login" placeholder="Nom d'utilisateur" type=text/></br>
          <label for="password1">Mot de passe: </label>
          <input name="new_password1" id="password1" placeholder="Mot de passe" type="password"/></br>
          <label for="password2">Confirmez votre mot de passe: </label>
          <input name="new_password2" id="password2" placeholder="Confirmer votre mot de passe" type="password"/></br>
          <input type="submit" name="inscription" value="S'inscrire"/>
        </fieldset>
      </form>
    </li>
  </ul>
</nav>
<script type="text/javascript">
  window.addEventListener('load', function() {
    var a=document.getElementById('log');
    var b=document.getElementById('subscribe');
    var c=document.getElementById('connexion');
    var d=document.getElementById('inscription');
    var e=document.getElementsByTagName('li');
    var f=document.getElementsByClassName('event');
    c.style.display='none';
    d.style.display='none';
    for (var i=0; i<e.length; i=i+1) {
      e[i].style.listStyleType='none';
    }
    a.addEventListener('click', function() {
      if (f!=null) {
        for (var j=0; j<f.length; j=j+1) {
          f[j].style.display ='none';
        }
      }
      if (c.style.display=='none') {
        d.style.display = 'none';
        c.style.display = 'block';
      } else {
        c.style.display = 'none';
      }
    });
    b.addEventListener('click', function() {
      if (f!=null) {
        for (var k=0; k<f.length; k=k+1) {
          f[k].style.display ='none';
        }
      }
      if (d.style.display=='none') {
        c.style.display = 'none';
        d.style.display = 'block';
      } else {
        d.style.display = 'none';
      }
    });
  });
</script>
<?php
} else {
?>
<h1>Bienvenue <?php echo $_SESSION['username']; ?> </h1>
<nav>
  <form method="POST" action="deconnexion.php">
    <input type="submit" name="deconnexion" value="Se déconnecter"/>
  </form>
</nav>
<p id='game'><a href='game.php'>Veuillez cliquer ici pour jouer</a></p>
<?php
  }
?>
