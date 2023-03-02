<?php
session_start();
if (!isset($_SESSION['nom'])) {
	header("location:connection.php");
}
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="css.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">
	<style type="text/css">
		#bor {
			border-style: solid;
		}

		#div3 {
			background-color: grey;
		}

		.h3 {
			text-align: center;
			font-family: cursive;
		}

		.h2 {
			text-align: center;
			color: red;
			font-family: serif;
		}
		#h4 {
			color: green;
		}

		.j {
			visibility: hidden;
		}
		.bg-secondary{
			margin: 12px 12px;
		}
	</style>
	<title></title>
</head>

<body>
	<section>
		<header>
			<?php
			require "navbar.php";
			require "connDatabase.php";
			$infos = $conn->prepare("SELECT * FROM responsables where num_respo = :numrespo");
			$infos->bindValue(":numrespo", $_SESSION['num']);
			$infos->execute();
			while ($info = $infos->fetch()) {
				$_SESSION["prenom_respo"] = $info["prenom_respo"];
				$_SESSION['type_responsabilte'] = $info["type_responsabilte"];
				$_SESSION['rang_scout'] = $info["rang_scout"];
			}
			?>
		

		<h2 class="h3 font-weight-bold text-uppercase px-3 py-2 px-0 px-lg-2">Ajouter un adhérant</h2>
		<h2 class="h2" id="h2"></h2>
		<h2 class="h2" id="h3"></h2>
		<h2 class="h2" id="h4"></h2>


		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="singnup-form">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-5">
							<div class="row" id="div3">
								<h3 class="h3 font-weight-bold text-uppercase px-3 py-2 px-0 px-lg-2">entrez les information</h3>
								<div class="mb-3 col-md-6">
									<label>الاسم</label>
									<input type="text" name="Fname" class="form-control">
								</div>

								<div class="mb-3 col-md-6 ">
									<label>النسب</label> 
									<input type="text" name="Lname" class="form-control">
								</div>

								<div class="mb-3 col-md-6">
									<label>العمر  </label>
									<input type="number" name="age" class="form-control" min="5">
								</div>

								<div class="mb-3 col-md-6">
									<label>تاريخ الازدياد </label>
									<input type="date" name="DateN" class="form-control">
								</div>


								<div class="mb-3 col-md-6">
									<label> قيمة المساهمة </label>
									<input type="number" name="Vapp" class="form-control" min="50">
								</div>


								<div class="mb-3 col-md-6">
									<label> رقم التسجيل </label>
									<input type="text" name="idad" class="form-control">
								</div>

								<div class="mb-3 col-md-6">
									<label> الجنس </label> <br>
									<div id="bor">
										<input type="radio" class="j">
										<input type="radio" class="j">

										<input type="radio" name="sex" value="masculin"> M
										<input type="radio" name="sex" value="feminin"> F
									</div>
								</div>

								<div class="mb-3 col-md-6">
									<label>الصفة</label>
									<select name="RSC">
										<option value="none">chose one </option>
										<option value="الاشبال والزهرات"> الاشبال والزهرات </option>
										<option value="الكشافة والمرشدات"> الكشافة والمرشدات </option>
										<option value="الكشاف المتقدم والرائدات"> الكشاف المتقدم و الرائدات </option>
										<option value="الجوالة والدليلات"> الجوالة و الدليلات </option>
										<!-- <option value="لقادة و القائدات "> القادة و القائدات </option> -->
									</select>
								</div>

								<div class="mb-3 col-md-6">
									<label> المجموعة التربوية  </label>
									<select name="grp">
										<option value="none">Chose one </option>
										<option value="group educatif Najma">المجموعة التربوية النجمة </option>
										<option value="group educatif Andaloss">المجموعة التربوية الأندلس </option>
									</select>
								</div>
								<div class="mb-3 col-md-6">
								<label> حالة الانخراط </label>
								<select name="statuss" disabled  >
									<option value="none"> Chose one </option>
									<option  selected> &nbsp;  &nbsp; &nbsp;&nbsp; مفعل &nbsp;&nbsp; &nbsp; &nbsp; </option>
									<option> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; غير مفعل &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</option>
								</select>
							</div>

								<div class="mb-3 col-md-6">
									<label>تأكيد  </label>
									<button type="submit" name="ajouter" class="btn btn-success">Ajouter adhérant</button>
								</div>


							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



		<?php
		if (isset($_POST['ajouter'])) {
			if (
				!empty($_POST['Fname']) && !empty($_POST["Lname"]) && !empty($_POST["age"]) && !empty($_POST["DateN"])  &&
				(!empty($_POST["RSC"]) && $_POST["RSC"]!= "none") && !empty($_POST["Vapp"]) && (!empty($_POST["grp"]) && $_POST["grp"]!= "none") && !empty($_POST['sex']) && !empty($_POST['idad'])
			) {
				require "connDatabase.php";
				$_SESSION['fname'] = $_POST['Fname'];
				$_SESSION['lname'] = $_POST["Lname"];
				$_SESSION['id'] = $_POST['idad'];
				$_SESSION['age'] = $_POST["age"];
				$_SESSION['daten'] = $_POST["DateN"];
				$_SESSION['RSC'] = $_POST["RSC"];
				$_SESSION['vapp'] = $_POST["Vapp"];
				$_SESSION['grp'] = $_POST["grp"];
				$_SESSION['sex'] = $_POST['sex'];


				$baghi = $_SESSION['id'];
				$testid = $conn->prepare("SELECT * From adherants");
				$testid->execute();
				$ch = false;
				while ($ts = $testid->fetch()) {
					if ($_SESSION['id'] == $ts["num_inscription"] || ($_SESSION['fname'] == $ts["prenom_adherant"] && $_SESSION['lname'] == $ts["nom_adherant"])) {
						$ch = true;
						break;
					}
				}
				if ($ch == false) {
					$adherant = $conn->prepare("INSERT INTO adherants
						(num_inscription,nom_adherant, prenom_adherant, age, date_naissance, rang, gender, mossahama, group_scout)
					  VALUES(:id, :nom, :prenom, :age, :date_naissance, :rang, :gender, :mon, :groupe)");
					$adherant->bindvalue(":id", $_SESSION['id']);
					$adherant->bindvalue(":nom", $_SESSION['lname']);
					$adherant->bindvalue(":prenom", $_SESSION['fname']);
					$adherant->bindvalue(":age",	$_SESSION['age'] = $_POST["age"]);
					$adherant->bindvalue(":date_naissance", $_SESSION['daten']);
					$adherant->bindvalue(":rang", $_SESSION['RSC']);
					$adherant->bindvalue(":gender", $_SESSION['sex']);
					$adherant->bindvalue(":groupe", $_SESSION['grp']);
					$adherant->bindvalue(":mon", $_SESSION['vapp']);
					$adherant->execute();
					?>
					<script>
						document.getElementById('h4').innerHTML = 'L\'adherant a ete bien saisi et entre dans la base de donnes'

					</script>
				<?php
				} else {
		?>
					<script>
						document.getElementById('h2').innerHTML = 'Ce numero d\'adherant ou le nom complet existe deja Veuillez verifier le table d\'adheant  :'
						document.getElementById('h3').innerHTML += '<a href="affadherants.php" class="nav-link text-dark font-weight-bold text-uppercase px-3 py-2 px-0 px-lg-2">Afficher les adherant</a>'

					</script>
				<?php
				}
			} else { ?>
				<script>
					document.getElementById('h2').innerHTML = 'Veuillez remplire les champs'
				</script>
		<?php
			}
		}

		?>



	</section>
</body>

</html>