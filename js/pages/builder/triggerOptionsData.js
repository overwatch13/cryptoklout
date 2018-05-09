define([], function () {
	var _triggerOptions = function(){
		// this should come from the database so it can be updated remotely.
		return {
			// Each data point would also have to have meta data so the user can decide which one to add next. 
			"options": {
				"direction": {
					"decreases": {
						dbId: 1,
					},
					increases: {
						dbid: 2
					},
					reaches: {
						dbid: 3
					}
				}
			}
		}
	};

	return{
		getTriggerOptions : _triggerOptions,
	}
});