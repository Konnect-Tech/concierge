<?php

/***************************************************************************
 * 여러번 호출시 에러 발생 금지
 **************************************************************************/
if($_konc_function_php_excuted) return;
$_konc_function_php_excuted = true;

function get_hospitals_by_paginate(int $page = 1, int $limit = 10, ?Closure $filter = null): array{
	$page = max(1, $page);
	$limit = max(1, min(50, $limit));

	$contents = file_get_contents("https://api.medical.konnect-promo.com/api/v1/hospitals?page=$page&limit=$limit");
	if($contents === false){
		return [];
	}

	$parse = json_decode($contents, true);
	if(!is_array($parse) || !$parse['success']){
		return [];
	}

	if($filter === null){
		$filter = function(array $data): array{ return $data; };
	}

	return array_map(static function(array $data) use ($filter): array{
		return $filter($data);
	}, (array) ($parse['data'] ?? []));
}

function get_hospitals(string $key, string $valueTarget, ?Closure $filter = null): array{
	$page = 1;
	$hospitals = [];
	while(true){
		$hospitalsByFiltering = get_hospitals_by_paginate($page, 50, $filter);
		if(count($hospitalsByFiltering) === 0){
			break;
		}
		foreach($hospitalsByFiltering as $data){
			$hospitals[$data[$key]] = $data[$valueTarget];
		}
		++$page;
	}
	print_r($hospitals,"sdsdsdsdsds");
	return $hospitals;
}

function get_hospital(string $id): array{
	$contents = file_get_contents("https://api.medical.konnect-promo.com/api/v1/hospitals/$id");
	if($contents === false){
		return [];
	}

	$parse = json_decode($contents, true);
	if(!is_array($parse) || !$parse['success']){
		return [];
	}

	return $parse['data'];
}

function get_reservations(string $email): array{
	$contents = file_get_contents("https://api.medical.konnect-promo.com/api/v1/reservations?email=$email");
	if($contents === false){
		return [];
	}

	$parse = json_decode($contents, true);
	if(!is_array($parse) || !$parse['success']){
		return [];
	}

	return $parse['data'];
}

function get_reservation(string $reserve_id): array{
	$ch = curl_init("https://api.medical.konnect-promo.com/api/v1/reservations/$reserve_id");
	curl_setopt_array($ch, [
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_SSL_VERIFYPEER => false
	]);

	$response = json_decode(curl_exec($ch), true);
	curl_close($ch);

	if(!isset($response['success']) || !$response['success']){
		return [];
	}

	if(!isset($response['data']) || !is_array($response['data'])){
		return [];
	}

	return $response['data'];
//	$contents = file_get_contents("https://api.medical.konnect-promo.com/api/v1/reservations/$reserve_id");
//	if($contents === false){
//		return [];
//	}
//
//	$parse = json_decode($contents, true);
//	if(!is_array($parse) || !$parse['success']){
//		return [];
//	}
//
//	return $parse['data'];
}

function delete_reservation(string $reserve_id): array{
	$ch = curl_init("https://api.medical.konnect-promo.com/api/v1/reservations/$reserve_id");

	curl_setopt_array($ch, [
		CURLOPT_CUSTOMREQUEST => "DELETE",
		CURLOPT_RETURNTRANSFER => true
	]);
	$result = curl_exec($ch);
	$data = json_decode($result, true);
	if(!is_array($data) || !$data['success']){
		return [];
	}

	return $data['data'];
}

function treated_reservation(string $reserve_id): bool{
	$ch = curl_init("https://api.medical.konnect-promo.com/api/v1/reservations/$reserve_id");

	curl_setopt_array($ch, [
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => http_build_query(["status" => "Treated"])
	]);
	$response = json_decode(curl_exec($ch), true);
	curl_close($ch);

	if(!isset($response['success']) || !$response['success']){
		return false;
	}

	return true;
}