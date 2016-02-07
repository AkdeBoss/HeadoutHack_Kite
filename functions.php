<?php
function add_post($userid,$body){
	$sql = "INSERT INTO posts (user_id, body, stamp) 
			VALUES ($userid, '". mysql_real_escape_string($body). "',now())";

	$result = mysql_query($sql);
}

function show_posts($userid){
	$posts = array();

	$sql = "SELECT body, stamp FROM posts
	 WHERE user_id = '$userid' ORDER BY stamp DESC";
	$result = mysql_query($sql);

	while($data = mysql_fetch_object($result)){
		$posts[] = array( 	'stamp' => $data->stamp, 
							'userid' => $userid, 
							'body' => $data->body
					);
	}
	return $posts;

}

function show_users(){
	$users = array();
	$sql = "SELECT id, username from users  order by username";
	$result = mysql_query($sql);

	while ($data = mysql_fetch_object($result)){
		$users[$data->id] = $data->username;
	}
	return $users;
}

function following($userid){
	$users = array();

	$sql = "SELECT distinct user_id from following
			where follower_id = '$userid'";
	$result = mysql_query($sql);

	while($data = mysql_fetch_object($result)){
		array_push($users, $data->user_id);

	}

	return $users;

}







function check_count($first, $second){
	$sql = "select count(*) from following 
			where user_id='$second' and follower_id='$first'";
	$result = mysql_query($sql);

	$row = mysql_fetch_row($result);
	return $row[0];

}

function follow_user($me,$them){
	$count = check_count($me,$them);

	if ($count == 0){
		$sql = "insert into following (user_id, follower_id) 
				values ($them,$me)";

		$result = mysql_query($sql);
	}
}


function unfollow_user($me,$them){
	$count = check_count($me,$them);

	if ($count != 0){
		$sql = "delete from following 
				where user_id='$them' and follower_id='$me'
				limit 1";

		$result = mysql_query($sql);
	}
}

?>
