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

function createD(matiere)
{
		
	var em = emptyMatrix();

	var matrix = createTableAllPeopleWeight();
	var x = 0;

	for ( votant in em)
	{
		for ( cible in em[votant] )
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

	for( i in em)
	{
		var cj = 0;
		for ( j in em[i] )
		{
			x += em[i][j];
			cj += 1;
		}

		if ( x == 0 )
		{
			for ( j in em[i]  )
			{
				em[i][j] = ( 1 / cj );
			}
		}
		x = 0
	}

	return em;
}

function emptyMatrix()
{
	var table = new Array();
	for ( people in votes)
	{
		table[people] = new Array();
		for ( people2 in votes )
		{
			table[people][people2] = 0;
		}
	}

	return table;
}

function nothingMatrix()
{
	var table = new Array();
	for ( people in votes)
	{
		table[people] = new Array();
		for ( people2 in votes )
		{
			x+=1;
		}
		table[people][people2] = 1/x;
	}

	return table;
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

var table = createD("ACDA");

var s ="";

for ( people in votes )
{
	for ( people2 in votes )
	{
		s += ( table[people][people2] + " " );
	}
	s += "<br>";
} 
