<?php

$post_terms = '';
$post_contractions = '';

if (!isset($_POST['terms'])) {
    $post_terms = '\phi(x)
\phi(y)
\phi(z)
\phi(w)';
    $post_contractions = '0 1
2 3
1 3';
}
else {
    $post_terms = $_POST['terms'];
    $post_contractions = $_POST['contractions'];
}

$terms = explode("\n", $post_terms);
$contractions = explode("\n", $post_contractions);

$results = array();

for ($i = 0; $i < count($terms); ++$i) {
    $terms[$i] = trim($terms[$i]);
}

foreach ($contractions as $contraction) {
    $bits = explode(' ', $contraction);

    $a = (int) $bits[0];
    $b = (int) $bits[1];

    $p = array(
        implode(' ', array_slice($terms, 0, $a)),
        implode(' ', array_slice($terms, $a, 1)),
        implode(' ', array_slice($terms, $a+1, $b-$a-1)),
        implode(' ', array_slice($terms, $b, 1)),
    );

    $next = '\contraction{'.($p[0]).'}{'.($p[1]).'}{'.($p[2]).'}{'.($p[3]).'}';

    $results[] = $next;
}

?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title></title>
</head>
<body>

<h1>Generator for simplewick</h1>

<form action="" method="post">

<p>Insert your terms here, one on each line:</p>

<textarea rows="15" cols="30" name="terms"><?= $post_terms ?></textarea>

<p>Then insert the desired contractions of the terms, starting with 0:</p>

<textarea rows="15" cols="30" name="contractions"><?= $post_contractions ?></textarea>

</ br>

<input type="submit" />

</form>

<p>And here are the results:</p>

<pre>
<?php
foreach ($results as $result) {
    echo $result;
    echo "\n\n";
}
?>
</pre>

</body>
</html>
