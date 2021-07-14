<?php
	session_start();
	if(isset($_SESSION["Author_ID"])){
		require_once("connect.php");
		$query = "SELECT upvoters,downvoters FROM articles WHERE I_D=".$_POST['id'];
		$result = $conn_article->query($query);
		$decode;
		$upvoters;
		$downvoters;
		$voter = $_SESSION['Author_ID'];
		while($row = $result->fetch_assoc()){
			if(strlen($row['upvoters']!=0)){
				$upvoters = json_decode($row['upvoters']);
				// $upvoters = substr($row['upvoters'], 1,strlen($row['upvoters'])-2);
				// $upvoters = explode(",", $upvoters);
			}
			if(strlen($row['downvoters']!=0)){
				$downvoters=json_decode($row['downvoters']);
				// $downvoters = substr($row['downvoters'], 1,strlen($row['downvoters'])-2);
				// $downvoters = explode(",", $downvoters);
			}
		}
		// var_dump($upvoters);
		// var_dump($downvoters);
		if($_POST['vote']==1){
			if(!in_array($voter, $downvoters)){
				if(!in_array($voter, $upvoters)){
					array_push($upvoters,$voter);
		   		}else{
		   			$key = array_search($voter, $upvoters);
		   			unset($upvoters[$key]);
		   			$upvoters = array_values($upvoters);
		   		}
		   }else{
		   		$key = array_search($voter, $downvoters);
		   		unset($downvoters[$key]);
		   		$downvoters = array_values($downvoters);
		   		array_push($upvoters,$voter);
		   }
		}
		if($_POST['vote']==-1){
			if(!in_array($voter, $upvoters)){
				if(!in_array($voter, $downvoters)){
					array_push($downvoters,$voter);
		   		}else{
		   			$key = array_search($voter, $downvoters);
		   			unset($downvoters[$key]);
		   			$downvoters = array_values($downvoters);
		   		}
		   }else{
		   		$key = array_search($voter, $upvoters);
		   		unset($upvoters[$key]);
		   		$upvoters = array_values($upvoters);
		   		array_push($downvoters,$voter);
		   }
		}
		$numup= sizeof($upvoters);
		$numdown = sizeof($downvoters);
		// var_dump($upvoters);
		$upvoters = json_encode($upvoters);
		$downvoters = json_encode($downvoters);
		$query = "UPDATE articles SET upvotes ='$numup' ,downvotes='$numdown' ,upvoters='$upvoters' ,downvoters='$downvoters' WHERE I_D=".$_POST['id'];
		$result=$conn_article->query($query);
		echo "$numup,$numdown";
	}
?>