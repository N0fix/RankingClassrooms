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
