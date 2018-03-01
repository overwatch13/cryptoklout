<?php

class RanksViewLogic extends Standards{
  function main(){
    $masterArr = array();

    // bring back all users.
    // create a table, give everyone a rank of 400.
    // instantiate it with all the users in the user table, or find a good way to instantiate it.
    // Ability to create a new record into a table, for every existing user that currently exists.
    // *** Good for instantiating a new table with the current users id's ***
    // INSERT INTO user_crypto_score (userId) SELECT DISTINCT id FROM user;

    // Grab all of the users klout scores.
    // This should be extracted to its own class somewhere. under /_classes/
    $sql = "SELECT u.email, ucs.userId, ucs.cryptoScore, ui.first_name, ui.last_name, ui.picture ";
    $sql .=" FROM user u, user_crypto_score ucs, user_info ui ";
    $sql .= " WHERE u.id = ucs.userId AND u.id = ui.userId ";
		$query = $this->query($sql, 'fetch');
    $users = $query;

    // Sort the users by cryptoScore highest first.
    usort($users, function ($a, $b) {
        return $a['cryptoScore'] < $b['cryptoScore'];
    });

    $masterArr['users'] = $users;

    // Ok we are simply going to do a sort, and than a simple list view, and we are pretty much done with this page.
    // All of the other logic is going to be on the processing side, of actually calculating and updating the clout number nightly, or every 6 hours etc.


    $return = array(
			"masterArr"=>$masterArr,
      "sql"=>$sql,
		);
		return $return;
  }
}
