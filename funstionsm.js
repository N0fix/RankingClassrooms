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

	function createD(matiere, matrix)
	{
		
		var em = emptyMatrix();
		int x = 0;

		for ( votant in em)
		{
			for ( cible in votant )
			{
				for ( vote in votes[votant])
				{
					if ( cible == vote )
					{
						em[votant][cible] = matrix[votant][matiere];
					}
				}
			}
		}

		return em;
	}

	function emptyMatrix()
	{
		var table = new Array();
		var x = 0;
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

		for( i in table)
		{
			var cj;
			for ( j in table[i] )
			{
				x += table[i][j];
				cj = j;
			}

			if ( x == 0 )
			{
				for ( j in table[i] )
				{
					table[i][j] = 1 / cj;
				}
			}
		}

		return table;
	}
