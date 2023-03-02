<?php
require "connDatabase.php";
    

?>
    <table>
        <tr>
            <td>Nom</td>
            <td>prenom</td>
            <td>age </td>
            <td>date de date_naissance</td>
            <td>Rang scout</td>
        </tr>	
        <?php
			$affall = $conn->prepare("SELECT * FROM adherants");
			$affall->execute();
			while ($afa = $affall->fetch()) {
        ?>	
        <tr>
        <td><?= $afa["nom_adherant"] ?></td>
		<td><?= $afa["prenom_adherant"] ?></td>
		<td><?= $afa["age"] ?></td>
		<td><?= $afa["date_naissance"] ?></td>
		<td><?= $afa["rang"] ?></td>
        </tr>
<?php 
};?>
    </table>
    <?php
    header("Content-Type: application/xls;");
    header("Content-Disposition: attachment; filename=donload.xls");
    ?>