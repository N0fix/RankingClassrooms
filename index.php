<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8" />
  <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=pagerank.js"></script>
  <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=logins.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <script src="js/funstionsm.js"></script>
</head>
<center>
  <h3>Please refresh the page between each rank calcul</h3>
</center>
<body style="margin:5%">
  <h3>Matière</h3>
  <form action="index.php" method="post">

    <p>
      <input type="checkbox" class="matiere[]" id="ACDA" value="ACDA"/>
      <label for="ACDA">ACDA</label>
    </p>

    <p>
      <input type="checkbox" class="matiere[]" id="ANG" value="ANG"/>
      <label for="ANG">ANG</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="APL" value="APL"/>
      <label for="APL">APL</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="ART" value="ART"/>
      <label for="ART">ART</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="ASR" value="ASR"/>
      <label for="ASR">ASR</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="EC" value="EC"/>
      <label for="EC">EC</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="EGOD" value="EGOD"/>
      <label for="EGOD">EGOD</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="MAT" value="MAT"/>
      <label for="MAT">MAT</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="SGBD" value="SGBD"/>
      <label for="SGBD">SGBD</label>
    </p>
    <p>
      <input type="checkbox" class="matiere[]" id="SPORT" value="SPORT"/>
      <label for="SPORT">SPORT</label>
    </p>


  </form>
  <br />
  <button class="waves-effect waves-light btn" onclick="printScores()">Afficher le classement</button>

  <table id="table" class="highlight">
    <thead>
      <tr>
        <th>
          Rang
        </th>
        <th>
          Nom
        </th>
      </tr>
    </thead>
    <td>

    </td>
  </table>



</body>
</html>
