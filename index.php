<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=pagerank.js"></script>
    <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=logins.js"></script>
    <script type="text/javascript">
      var matiere = "<?php
      if(!isset($_POST['matiere'])){
        echo '';
      } else {
        echo $_POST['matiere'];
      } ?>";
      console.log(matiere);
    </script>
  </head>

  <body>
    <form action="index.php" method="post">
      Matière:<br>
        ACDA : <input type="checkbox" name="matiere" value="ACDA"><br>
        ANG : <input type="checkbox" name="matiere" value="ANG"><br>
        APL : <input type="checkbox" name="matiere" value="APL"><br>
        ART : <input type="checkbox" name="matiere" value="ART"><br>
        ASR : <input type="checkbox" name="matiere" value="ASR"><br>
        EC : <input type="checkbox" name="matiere" value="EC"><br>
        EGOD : <input type="checkbox" name="matiere" value="EGOD"><br>
        MAT : <input type="checkbox" name="matiere" value="MAT"><br>
        SGBD : <input type="checkbox" name="matiere" value="SGBD"><br>
        SPORT : <input type="checkbox" name="matiere" value="SPORT"><br>
    </form>
    <br />
    <button onclick="test()">Afficher le classement</button>
    <div id="loader" class="loader"></div>
    <p id="test">
    </p>
  </body>
</html>


<script>
  function test(){
    //showAllVotes();
    var m1 = [[1,2],[3,4]], m2 = [[2,3],[6,5]];
    var res = multiplyTwoMatrix(m1, m2);
    console.table(res);
    console.table(multiplyMatrix(m1, 2));
  }

  function multiplyTwoMatrix(matrix1, matrix2){
    var resultMatrix = [];
    for (var i = 0; i < matrix1.length; i++) {
        resultMatrix[i] = [];
        for (var j = 0; j < matrix2[0].length; j++) {
            var sum = 0;
            for (var k = 0; k < matrix1[0].length; k++) {
                sum += matrix1[i][k] * matrix2[k][j];
            }
            resultMatrix[i][j] = sum;
        }
    }
    return resultMatrix;
  }

  function multiplyMatrix(matrix, value){
    for (var i = 0; i < matrix.length; i++) {
        for (var j = 0; j < matrix[i].length; j++) {
            matrix[i][j] *= value;
        }
    }
    return matrix;
  }

  //TODO test it
  function emptyDictionnary(dictionnary){
    for(value in dictionnary){
      value = 0;
    }
  }

  //VoteList for each matiereList TODO
  /*
  *voteList[0] should correspond to the matrix of votes of matiereList
  *ex : voteList[0] is the matrix of vote for ACDA, which is matiereList[0] (matiereList[0] == ACDA)
  */
  function calculateRanking(matiereList, voteList){
    var matrix = [];
    for(names in vote){
      for(matiere in vote){
        matrix[matiere] = [];
        matrix[matiere][0] = valeur;
      }
    }
  }



  function classementMatiere(matiere){
    for(name in votes){
      var vote_value = getPeopleVoteValue(name[matiere], name);
      for(votedname in votes[name][matiere]){ //On ajoute la valeur au nom correspondant dans le dictionnaire
        dictionnary[votes[name][matiere][votedname]] += vote_value;
      }
    }
    dictionnary = sortDictionnaryByValue(dictionnary);
  }

  function sortDictionnaryByValue(dictionnary){
    var result = Object.keys(dictionnary).sort(function(a, b) {
      return data[b] - data[a];
    });
    return result;
  }

  function showAllLogins(){
    var text = "";
    for(x in logins){
      console.log(x + " = " + logins[x] + "");
    }
  }




  function showAllVotes(){
    var text = "";
    for(name in votes){
      for(matiere in votes[name]){
        for(votedname in votes[name][matiere]){
          text += name + " voted in " + matiere + " : "  + votes[name][matiere][votedname] + "<br />";
          document.getElementById("test").innerHTML = text;
        }
      }
    }
  }
</script>
