<?php

class Credit{
		
	public $user;
	private $link;
	
	public function getConnection(){
		$this->link = mysqli_connect("localhost","root","","t3cn0lo1t3_c5_c0r3") or die("Error " . mysqli_error($link));
		return $this->link;
	}
	
	public function getDisponible($user){
		$this->user = $user;
		$link = $this->getConnection();
		
		$query = "select sum(credit) as disponible from credits where user_id = " . $this->user;
		$result = $link->query($query);
		
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		return (float) round($row["disponible"], 0);
	}
	
	public function getCanjeado($user){
		$this->user = $user;
		$link = $this->getConnection();
		
		$query = "select sum(payments) as canjeado FROM credits_history where id_username = " . $this->user;
		$result = $link->query($query);
		
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		return (float) round($row["canjeado"], 0);
	}
	
	
	
	public function getAcumulado($user){
		$this->user = $user;
		$total_orders = $this->getCanjeado($this->user);
		$total_credit = $this->getDisponible($this->user);
		
		return $total_orders + $total_credit;
	}
	
}
