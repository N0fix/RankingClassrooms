<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=pagerank.js"></script>
    <script src="http://www.iut-fbleau.fr/projet/maths/?rah_external_output=logins.js"></script>


  </head>

  <body>
    <form action="index.php" method="post">
      Matière:<br>
        ACDA : <input type="checkbox" class="matiere[]" value="ACDA"><br>
        ANG : <input type="checkbox" class="matiere[]" value="ANG"><br>
        APL : <input type="checkbox" class="matiere[]" value="APL"><br>
        ART : <input type="checkbox" class="matiere[]" value="ART"><br>
        ASR : <input type="checkbox" class="matiere[]" value="ASR"><br>
        EC : <input type="checkbox" class="matiere[]" value="EC"><br>
        EGOD : <input type="checkbox" class="matiere[]" value="EGOD"><br>
        MAT : <input type="checkbox" class="matiere[]" value="MAT"><br>
        SGBD : <input type="checkbox" class="matiere[]" value="SGBD"><br>
        SPORT : <input type="checkbox" class="matiere[]" value="SPORT"><br>
    </form>
    <br />
    <button onclick="printScores()">Afficher le classement</button>

    <table id="table">
      <th>
        <tr>

        </tr>
      </th>
      <td>

      </td>
    </table>



  </body>
</html>


<script>
  console.log(getNumberParticipants());
  function printScores(){



    var dict = newDictionnary();
    var matiere = getCheckedMatiere();
    var resultMatrix = emptyMatrix();

    console.log("Matiere length " + matiere.length);

    for(var i = 0; i < matiere.length; i++){
      var matrix = createD(matiere[i]);
      matrix = multiplyMatrixWithValue(matrix, 0.90);

      var secondMatrix = emptyMatrix(); //Looks like it works fine

      secondMatrix = addMatrixWithValue(secondMatrix, getDefaultVoteValue()); //Non empty matrix

      secondMatrix = multiplyMatrixWithValue(secondMatrix, 0.10); //Let's just multiply this with a value

      var endMatrix = addMatrix(matrix, secondMatrix);

      for(var j = 0; j < 10; j++){
        endMatrix = multiplyTwoMatrix(endMatrix, endMatrix);
      }

      dict = dictAndMatrix(dict, matrix);

    }
    dict = sortDictionnary(dict);
    generateTab(dict);
}

  function generateTab(dict){
    var table = document.getElementById("table").getElementsByTagName("tbody")[0];
    let nb = getNumberParticipants();

    let w = 0;
    for(login in dict){
      let newRow = table.insertRow(w);
      let cellrang = newRow.insertCell(0);
      let cellnom = newRow.insertCell(1);
      cellrang.innerHTML = ""+(w+1);

      cellnom.innerHTML  = ""+loginToName(dict[login][0]);
      w++;
    }

  }


/* MATRIX MANIPULATION
*
*
*
  MATRIX MANIPULATION */


  function dictAndMatrix(dict, matrix){
    for(name in matrix){
      var val = 0;
      for(votedname in matrix){
        dict[votedname] += matrix[name][votedname];
      }
    }
    return dict;
  }

  function loginToName(login){
    for(name in logins){
      for(nique in name){
        if(login == name){
          return logins[name];
        }
      }
    }
    return "error";
  }


  function multiplyTwoMatrix(matrix1, matrix2){

    var resultMatrix = [];
    for(i in matrix1){
      resultMatrix[i] = [];
      for(j in matrix2){
        var sum = 0;
        for(k in matrix1){
          sum += matrix1[i][k] * matrix2[k][j];
        }
        resultMatrix[i][j] = sum;
      }
    }
    return resultMatrix;
  }

  function multiplyMatrixWithValue(matrix, value){
    for(name in matrix){
      for(votedname in matrix[name]){
          matrix[name][votedname] *= value;
      }
    }
    return matrix;
  }

  function addMatrix(matrix1, matrix2){
    var matrix = emptyMatrix();
    for(name in matrix1){
      for(votedname in matrix1){
        matrix[name][votedname] = matrix1[name][votedname] + matrix2[name][votedname]
      }
    }
    return matrix;
  }

  function addMatrixWithValue(matrix, value){
    for(name in matrix){
      for(votedname in matrix[name]){
          matrix[name][votedname] += value;
      }
    }
    return matrix;
  }

  function getCheckedMatiere(){
    var matiere = [];
    var array = document.getElementsByClassName("matiere[]");
    for(var i = 0; i < array.length; i++){
      if(array[i].checked){
        matiere.push(array[i].value);
      }
    }
    return matiere;
  }


/* DICTIONNARY HANDLING
*
*
*
  DICTIONNARY HANDLING */

  function sortDictionnary(dict){
    var items = Object.keys(dict).map(function(key) {
        return [key, dict[key]];
    });
    // Sort the array based on the second element
    items.sort(function(first, second) {
        return second[1] - first[1];
    });
    // Create a new array with only the first 5 items
    return items;
  }



  function newDictionnary(){
    
    var dictionnary = [];
    let count = 0;
    for(name in logins){
      dictionnary[name] = 0;
      count++;
    }
    console.log("COUNT  = "+count);
    return dictionnary;
  }


  /* TESTS
  *
  *
  *
    TESTS */

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






  /* OTHER USEFULL STUFF
  *
  *
  *
    OTHER USEFULL STUFF -Guillaume-*/

    function getNumberParticipants(){
      let value = 0;
      for(name in logins){
        value++;
      }
      return value;
    }
    function getDefaultVoteValue(){
      var value = 0;
      for(name in logins){
        value++;
      }
      return 1/value;
    }



  function getPeopleVoteNumber(matiere, name)
    {
      var value = 0;
      for(x in votes[name][matiere])
      {
        value += 1;
      }
      return value;

    }
    function getPeopleVoteValue(matiere, name)
    {
      var x = getPeopleVoteNumber(matiere,name);
      if ( x == 0) return 0;
      else return ( 1 / x );
    }

    function createTableAllPeopleWeight()
    {
      var table = new Array();
      var x;
      for ( name in votes )
      {
        table[name] = new Array();
        for ( matiere in votes[name] )
        {
          table[name][matiere] = getPeopleVoteValue(matiere, name);
        }
      }

      return table;
    }

    function votantExiste(votant) /* A coder , il n'y a pas le votant dans l'obj si il a pas voté... */
    {
      if ( votes[votant] == null)
        return false
      return true;
    }

    function createDOld(matiere)
    {

      var em = emptyMatrix();

      var matrix = createTableAllPeopleWeight();

      var x = 0;

      for ( votant in em)
      {
        for ( cible in em[votant] )
        {

          if ( votantExiste(votant) )
          {

            for ( vote in votes[votant][matiere] )
            {
              if ( cible == votes[votant][matiere][vote] )
              {
                em[votant][cible] = matrix[votant][matiere];
              }

            }
          }
        }
      }

      for( i in em)
      {
        for ( j in em[i] )
        {
          x += em[i][j];
        }

        if ( x == 0 )
        {
          for ( j in em[i]  )
          {
            em[i][j] = getDefaultVoteValue();
          }
        }
        x = 0
      }

      return em;
    }

    function createD(matiere)
    {

      var em = emptyMatrix();

      var matrix = createTableAllPeopleWeight();

      var x = 0;

      for ( votant in votes)
      {
        for ( cible in votes[votant][matiere] )
        {
          if ( em[votant] != null )
            em[votant][cible] = matrix[votant][matiere];
        }
      }

      for( i in em)
      {
        for ( j in em[i] )
        {
          x += em[i][j];
        }

        if ( x == 0 )
        {
          for ( j in em[i]  )
          {
            em[i][j] = getDefaultVoteValue();
          }
        }
        x = 0
      }

      return em;
    }

    function emptyMatrix()
    {
      var table = new Array();
      var g = getNumberParticipants();
      for ( x in logins )
      {
        table[x] = new Array();
        for ( y in logins  )
        {
          table[x][y] = 0;
        }
      }

      return table;
    }



</script>
