<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <LINK href="css/main.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="images/Icon.png">
		<title>Jus Santé</title>
	</head>
	<body>
        <div class="header">
            <?php
            ob_start();
            session_start();
            include("includes/header.php");
            ?>
        </div>
        <div class = "content">
            <div class= "text_container">
            <h1>Jus Santé </h1>
            <p>Grâce à la thérapie par le jus, nous apportons à notre organisme les éléments dont il a besoin pour guérir tous les petits maux qui nous affectent, et pour l'aider à mieux fonctionner.</p>
            <p>La thérapie par le jus est une méthode qui gagne de plus en plus d’adeptes qui sont convaincus qu’une consommation de jus naturels va les aider à rester en bonne santé. Ces jus naturels sont à base de fruits et de légumes crus et bios de préférence, et vont nous permettre de détoxifier notre corps et de garder la forme pour un bon bout de temps ! Dans les lignes qui suivent, nous allons donc aborder quelques points essentiels sur la thérapie du jus, sa méthode et ses bienfaits pour le consommateur.</p>
            <p>Les bienfaits de la thérapie par le jus 
            La thérapie par le jus permet de détoxifier certains organes comme la peau, les poumons, les reins et le foie afin qu’ils fonctionnent beaucoup plus rapidement. Cela permettra l’élimination des toxines et des déchets qui s’accumulent dans notre corps et le repos de notre système digestif. </p>
            <p>Des jus à base de fruits et de légumes frais permettent à notre organisme de bénéficier d’une grande quantité de vitamines, de minéraux, d’oligoéléments, d’enzymes et de sucre naturels, ce qui permettra un meilleur fonctionnement de notre organisme et une régénération des cellules. Nous pourrons ainsi assimiler les nutriments de façon plus complète et immédiate.</p>
            <p>L’autre bienfait d’une thérapie par le jus est qu’elle nous aide à obtenir un équilibre correct entre l’alcalinité et l’acidité de notre corps, sachant qu’un excès d’acidité nous rend vulnérable à de nombreuses maladies. La consommation des minéraux organiques qui sont absorbés avec une grande facilité, comme le potassium, le silicium et le calcium, aide à rétablir les tissus et les cellules qui préviennent le vieillissement prématuré; La thérapie par le jus dispose également d’éléments médicinaux, d’hormones, de végétaux et d’antibiotiques naturels.</p>
            </div>
        </div>
        <div class = "footer">
            <?php
            include ("includes/footer.php");
            ?>
        </div>
    </body>
</html>