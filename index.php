<?php

$hotels = [
		[
				'name' => 'Hotel Belvedere',
				'description' => 'Hotel Belvedere Descrizione',
				'parking' => true,
				'vote' => 4,
				'distance_to_center' => 10.4
		],
		[
				'name' => 'Hotel Futuro',
				'description' => 'Hotel Futuro Descrizione',
				'parking' => true,
				'vote' => 2,
				'distance_to_center' => 2
		],
		[
				'name' => 'Hotel Rivamare',
				'description' => 'Hotel Rivamare Descrizione',
				'parking' => false,
				'vote' => 1,
				'distance_to_center' => 1
		],
		[
				'name' => 'Hotel Bellavista',
				'description' => 'Hotel Bellavista Descrizione',
				'parking' => false,
				'vote' => 5,
				'distance_to_center' => 5.5
		],
		[
				'name' => 'Hotel Milano',
				'description' => 'Hotel Milano Descrizione',
				'parking' => true,
				'vote' => 2,
				'distance_to_center' => 50
		],
];

// New array variable to store filtered hotels
$filtered_hotels = [];


// GET values from select input and check if they are defined and not equal to default empty string 
$park = isset($_GET['park']) && $_GET['park'] != "" ? $_GET['park'] : null;
$vote = isset($_GET['vote']) && $_GET['vote'] != "" ? $_GET['vote'] : null;


// FILTER original array and returns results in filtered_array
$filtered_hotels = array_filter($hotels, function($hotel) use ($park, $vote) {
	$hotel["parking"] ? $parking = "Yes" : $parking = "No";  // Convert hotel parking boolean to Yes/No string

	// If park is set but does not match the hotel's parking availability
	if ($park !== null && $parking != $park) {
		return false;
	}
	// If vote is set but dues not match the hotel's rating
	if ($vote !== null && $hotel["vote"] != $vote) {
		return false;
	}
	// Park and vote are defined and at least one of them meets the hotel's requirement, so that hotel is added to the filtered array
	return true;
});


// reset the array keys
$filtered_hotels = array_values($filtered_hotels);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Hotels</title>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
		crossorigin="anonymous">
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous" defer></script>
</head>

<body>
	<div class="container" style="width: 70vw">
		<h1 class="mb-5" style="text-align: center">HOTELS</h1>

		<!-- Form with input fields to filter Hotels -->
		<form action="" method="get" class="mb-5 mx-auto" style="width: 30%">
			<label for="park" class="form-label">Parcheggio disponibile</label>
			<select id="park" name="park" class="form-select form-select-sm mb-3"
				aria-label=".form-select-sm example">
				<option selected value="">Seleziona un'opzione</option>
				<option value="Yes">Sì</option>
				<option value="No">No</option>
			</select>
			<label for="vote" class="form-label">Punteggio</label>
			<select id="vote" name="vote" class="form-select form-select-sm mb-3"
				aria-label=".form-select-sm example">
				<option selected value="">Seleziona un'opzione</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<div class="mx-auto" style="width: 100%; text-align: center">
				<button class="btn btn-success me-5" type="submit">Filtra</button>
				<button class="btn btn-warning" type="reset">Cancella</button>
			</div>
		</form>

		<!-- Table to display hotels information -->
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Parking</th>
					<th scope="col">Rating</th>
					<th scope="col">Distance to Center</th>
				</tr>
			</thead>
			<tbody>

				<!-- Loop in filtered array -->
				<?php
				foreach ($filtered_hotels as $key => $hotel){ 

				// Variable to convert boolean to text
				$hotel["parking"] ? $parking = "Yes" : $parking = "No";
				?>

				<tr>
					<th scope="row"><?= $key + 1 ?></th>
					<td><?=$hotel["name"]?></td>
					<td><?=$parking?></td>
					<td><?=$hotel["vote"]?></td>
					<td><?=$hotel["distance_to_center"]?></td>
				</tr>
				<?php
		}
		?>
			</tbody>
		</table>
	</div>
</body>

</html>
