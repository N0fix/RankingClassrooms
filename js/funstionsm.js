


/*This function prints calculate and print the score */
function printScores(){
  var matiere = getCheckedMatiere();
  var dict = newDictionnary();
  var resultMatrix = emptyMatrix();
  console.log("Matiere length " + matiere.length);
  if(matiere.length == 0) return;
  for(var i = 0; i < matiere.length; i++){
    var matrix = createD(matiere[i]);
    matrix = multiplyMatrixWithValue(matrix, 0.90);
    var secondMatrix = emptyMatrix(); //Looks like it works fine
    secondMatrix = addMatrixWithValue(secondMatrix, getDefaultVoteValue()); //Non empty matrix
    secondMatrix = multiplyMatrixWithValue(secondMatrix, 0.10); //Let's just multiply this with a value
    let endMatrix = addMatrix(matrix, secondMatrix);
    console.log("Speedtest 1");
    let array = matrixToArray(endMatrix);
    for(let j = 0; j < 3; j++){
      array = multiplyTwoArray(array, array);
      //endMatrix = multiplyTwoMatrix(endMatrix, endMatrix);
    }
    console.log("Speedtest 2");
    let tmpMatrix = arrayToMatrix(array);
    dict = dictAndMatrix(dict, tmpMatrix);
  }
  dict = sortDictionnary(dict);
  generateTab(dict);
  console.log("Speedtest 3");
}

/* Generate HTML table depending on the dict(name:value)*/
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

/* Set matrix values into the dict(name:value)
Ex :
MATRIX =
      aslan beta
aslan   0.5   1
beta    0.5   0

The function will return the dict :
aslan : 1.5
beta : 0.5
*/
function dictAndMatrix(dict, matrix){
  for(name in matrix){
    var val = 0;
    for(votedname in matrix){
      dict[votedname] += matrix[name][votedname];
    }
  }
  return dict;
}

/* This function return the full name of an user depending on it's login*/
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

/*This function multiplies two matrix and return a matrix as a result*/
function multiplyTwoMatrix(matrix1, matrix2){
  let resultMatrix = [];
  let sum = 0;
  for(i in matrix1){
    resultMatrix[i] = [];
    for(j in matrix2){
      sum = 0;
      for(k in matrix1){
        sum += matrix1[i][k] * matrix2[k][j];
      }
      resultMatrix[i][j] = sum;
    }
  }
  return resultMatrix;
}

/*This function multiplies two arrays and return a arrays as a result*/

function multiplyTwoArray(array1, array2){

  var result = new Array();
    for (var i = 0; i < array1.length; i++) {
        result[i] = new Array();
        for (var j = 0; j < array2[0].length; j++) {
            var sum = 0;
            for (var k = 0; k < array1[0].length; k++) {
                sum += array1[i][k] * array2[k][j];
            }
            result[i][j] = sum;
        }
    }
    return result;
}


/*returns 0,1,2,3... indexed array of the given name indexed matrix*/
function matrixToArray(matrix){
  let resultArray = new Array();
  let whoVoted = 0;
  for(name in matrix){
    resultArray[whoVoted] = new Array();
    let whoVotedForWho = 0;
    for(votedname in matrix){
      resultArray[whoVoted][whoVotedForWho] = matrix[name][votedname];
      whoVotedForWho++;
    }
    whoVoted++;
  }

  return resultArray;
}

/*Returns a name indexed matrix depending on an 0.1.2 indexed array*/
function arrayToMatrix(array){
  let matrix = [];
  let indextonamei = "";
  for(let i = 0 ; i < array.length; i++){
    indextonamei = indexToName(i);
    matrix[indextonamei] = [];
    for(let j = 0; j < array[i].length; j++){
      matrix[indextonamei][indexToName(j)] = array[i][j];
    }
  }
  return matrix;
}


/*Multiply a matrix with a value*/

function multiplyMatrixWithValue(matrix, value){
  for(name in matrix){
    for(votedname in matrix[name]){
        matrix[name][votedname] *= value;
    }
  }
  return matrix;
}

/*Sums two matrixs*/

function addMatrix(matrix1, matrix2){
  var matrix = emptyMatrix();
  for(name in matrix1){
    for(votedname in matrix1){
      matrix[name][votedname] = matrix1[name][votedname] + matrix2[name][votedname]
    }
  }
  return matrix;
}


/*Sums a matrix with a value*/
function addMatrixWithValue(matrix, value){
  for(name in matrix){
    for(votedname in matrix[name]){
        matrix[name][votedname] += value;
    }
  }
  return matrix;
}

/*Get all checked checkboxes on the html form*/
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

/*Allows to know the name of the user based on an index based on "logins" variable*/
function indexToName(index){
  let i = 0;
  for(name in logins){
    if(i == index) return name;
    i++;
  }
  return "error";
}


/*Sorting dictionnary(name:value) by value*/
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


/*Create a new dictionnary(name:login) using all names on "logins" variable as keys, and
setting all values to 0*/
function newDictionnary(){

  var dictionnary = [];
  let count = 0;
  for(name in logins){
    dictionnary[name] = 0;
    count++;
  }
  console.log("Number of members = "+count);
  return dictionnary;
}


  /* OTHER USEFULL STUFF
  *
  *
  *
    OTHER USEFULL STUFF*/


/*Returns number of participants based on "logins" variable*/
  function getNumberParticipants(){
    let value = 0;
    for(name in logins){
      value++;
    }
    return value;
  }

/*Returns default vote value for someone that didn't vote*/
  function getDefaultVoteValue(){
    var value = 0;
    for(name in logins){
      value++;
    }
    return 1/value;
  }


/*Know the number of people someone voted on a matiere*/
  function getPeopleVoteNumber(matiere, name)
  	{
  		var value = 0;
  		for(x in votes[name][matiere])
  		{
  			value += 1;
  		}
  		return value;

  	}
    /* get the vote value of people(name) in the matter(matiere) */
  	function getPeopleVoteValue(matiere, name)
  	{
  		var x = getPeopleVoteNumber(matiere,name);
  		if ( x == 0) return 0;
  		else return ( 1 / x );
  	}
    /* Create an array of people vote value
      Use login to navigate  */
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

    /* check if a people is in the votes object */
  	function votantExiste(votant)
  	{
  		if ( votes[votant] == null)
  			return false
  		return true;
  	}

    /* Create a matrix of people vote value and fill with neutral value the votes of people who didn't vote */
  	function createD(matiere)
  	{

  		var em = emptyMatrix();

  		var matrix = createTableAllPeopleWeight();

  		var x = 0;

  		for ( votant in em) /* browse the voters */
  		{
  			for ( cible in em[votant] ) /* browse the digital votes of voters */
  			{

  				if ( votantExiste(votant) ) /* if the voter exist in the votes object, */
  				{

	  				for ( vote in votes[votant][matiere] ) /* browse the real votes of the voters */
	  				{
	  					if ( cible == votes[votant][matiere][vote] ) /* if the real vote exist */
	  					{
	  						em[votant][cible] = matrix[votant][matiere]; /* fill the case with the voter vote value */
	  					}

	  				}
	  			}
  			}
  		}

      /* fill the neutrals value */
  		for( i in em)
  		{
  			for ( j in em[i] )
  			{
  				x += em[i][j];
  			}

  			if ( x == 0 ) /* if the sum of vote value is null, fill the case with voter default vote value */
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
    /* create a voters and vote matrix and fill it with 0 */
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
