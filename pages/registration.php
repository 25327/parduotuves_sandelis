<?php
//var_dump($_POST);
if (isset($_POST['pastas'])) {
    $email = $_POST['pastas'];
    $name = $_POST['vardas'];
    $position = $_POST['pareigybe'];
    $password = $_POST['slaptazodis'];

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Neteisingas el. paštas';
    }

    if (strlen($password) < 7) {
        $errors['password'][] = 'Slaptažodis turi būti ilgesnis nei 7 simboliai';
    }

    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'][] = 'Slaptažodyje turi būti raidė ir skaičius';
    }

    if (strlen($name) < 2 || strlen($name) > 50) {
        $errors['name'][] = 'Vardas yra per ilgas arba per trumpas';
    }

    if ($email == $password) {
        $errors['password'][] = 'Slaptažodis ir el. paštas negali būti vienodi';
    }

    $checkEmail = mysqli_query($database, 'select * from darbuotojai where pastas = "' . $email . '"');
    $checkEmail = mysqli_fetch_row($checkEmail);
    if ($checkEmail != null) {
        $errors['email'][] = 'Paštas užimtas';
    }

    if (empty($errors)) {
        $sql = 'insert into darbuotojai (vardas, pareigybe , pastas, slaptazodis) value ("' . $name . '", "' . $position . '", "' . $email . '", "' . $password . '")';
        $user = mysqli_query($database, $sql);
//        var_dump($sql);
        if ($user != false) {
            header('Location: index.php?page=login&email=' . $email);
        } else {
            echo 'Nepavyko sukurti vartotojo';
        }
    }
}
?>

<form action="index.php?page=register" method="post">
    <fieldset>
        <legend>Registracija:</legend>
        Vardas: <input type="text" name="vardas" value="<?php echo $name ?? null ?>">
        <?php
        if (isset($errors['name'])) {
            echo implode(',', $errors['name']);
        }
        ?>
        <br><br>
        Pareigos: <select name="pareigybe">
            <option value="sandelio_darbuotojas"
                <?php
                if (($position ?? null) == 'sandelio_darbuotojas') {
                    echo 'selected';
                }
                ?>
            >
                Sandėlio darbuotojas
            </option>
            <option value="parduotuves_darbuotojas"
                <?php
                if (($position ?? null) == 'parduotuves darbuotojas') {
                    echo 'selected';
                }
                ?>
            >
                Parduotuvės darbuotojas
            </option>
        </select>
        <br><br>
        El. paštas: <input type="email" name="pastas" value="<?php echo $email ?? null ?>">
        <?php
        if (isset($errors['email'])) {
            echo implode(',', $errors['email']);
        }
        ?>
        <br><br>
        Slaptažodis: <input type="text" name="slaptazodis">
        <?php
        if (isset($errors['password'])) {
            echo implode(',', $errors['password']);
        }
        ?>
        <br><br>
        <button type="submit">Registruotis</button>
    </fieldset>
</form>