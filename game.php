<!DOCTYPE>
<html>
  <head>
    <title>Le pendu</title>
    <meta charset="utf-8">
  </head>
  <body>
    <header>
    </header>
    <main>
      <?php
        require 'login.php';
        if (!isset($_SESSION['username'])) {
          header("location:index.php");
        }
      ?>
      <!-- on récupère un mot dans la base de données -->
      <?php
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
          $request = $_DB->prepare('SELECT * FROM pendu');
          $request->execute();
          $data=$request->fetchALL();
          $choix=mt_rand(0,count($data)-1);
          echo '<p id="cache">'.$data[$choix]['mots'].'</p>';
        } catch (PDOException $e) {
          print "Error!: ".$e->getMessage(). "<br/>";
          die();
        }
      ?>
      <script type='text/javascript'>
        window.onload = function() {
          var e=document.getElementById('game');
          if (e!=null){
            // on cache le lien vers la page 'game.php'
            e.style.display='none';
          }
          var a=document.getElementById('cache');
          if (a!=null){
            // on récupère le mot qui vient de la base de données
            var mot=a.innerHTML;
            // ensuite on cache ce mot
            a.style.display = 'none';
            // on crée une div
            var div=document.createElement('div');
            // on lui met un id 'alphabet'
            div.setAttribute('id','alphabet');
            // on met la div qu'on a créé dans le main
            document.getElementsByTagName('main')[0].appendChild(div);
            // on crée un tableau qui contient les lettres de l'aphabet
            var alphabet=[ 'A' , 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            // on crée des input qui ont chacun pour valeur par défaut une lettre de l'aphabet
            var input;
            for (var k=0; k<alphabet.length; k=k+1) {
              var a=alphabet[k];
              input=document.createElement('input');
              input.setAttribute('type', 'button');
              input.setAttribute('class', 'lettre');
              input.setAttribute('value', a);
              div.appendChild(input);
              input='';
            }
            // on crée une div pour y mettre autant de tiret qu'il y a de lettre dans le mot à trouver
            var p=document.createElement('div');
            p.setAttribute('id','new');
            var reponse=[];
            for (var i=0; i<mot.length; i=i+1) {
              reponse[i]='_';
            }
            p.innerHTML=reponse.join(' ');
            // on met la div contenant les tirets dans le main
            document.getElementsByTagName('main')[0].appendChild(p);
            // on récupère les input contenant les lettres de l'aphabet
            var alpha=document.getElementsByClassName('lettre');
            var vie=6;
            var check=mot.length;

            alpha[0].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[0].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[1].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[1].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[2].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[2].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[3].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[3].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[4].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[4].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[5].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[5].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[6].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[6].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[7].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[7].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[8].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[8].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[9].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[9].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[10].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[10].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[11].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[11].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[12].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[12].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[13].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[13].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[14].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[14].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[15].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[15].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[16].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[16].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[17].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[17].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[18].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[18].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[19].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[19].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[20].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[20].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[21].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[21].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[22].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[22].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[23].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[23].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[24].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[24].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };

            alpha[25].onclick=function(){
              var long=mot.length;
              if (vie>=0) {
                if (vie==0) {
                  alert("Perdu! Veuillez recharger la page pour jouer à nouveau!");
                }
                for (var n=0; n<mot.length; n++) {
                  if (mot[n]==alpha[25].value) {
                    reponse[n]=mot[n];
                    p.innerHTML=reponse.join(' ');
                    long--;
                    check--;
                    if (check==0) {
                      alert('Bien joué! Veuillez recharger la page pour continuer à jouer');
                      break;
                    }
                  }
                }
                if (long==mot.length){
                  vie=vie-1;
                }
              }
            };
          }
        };
      </script>
    </main>
    <footer>
    </footer>
  </body>
<html>
