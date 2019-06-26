<?php
//блок понключения к БД
$host='localhost';
$user='newuser';
$password='123';
$db_name='users';
$link=mysqli_connect($host,$user,$password,$db_name);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>The guest book</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
    <h1>The guest book</h1>
    <?php
    $count=" SELECT COUNT(*)  FROM users.miniproject ";//блок подсчета строк в базе
    $result_count=mysqli_query($link, $count) or die(mysqli_error($link));
    $array_count=mysqli_fetch_array($result_count);
    $last_count=$array_count[0]+2;//количество строк с костылем(нужно придумать что делать если порядок айди нарушен)
    if (isset ($_GET['page'])){//запрос и дефалтная установка страницы
        $page=$_GET['page'];
    }else{
        $page=1;
    }
    $notesOnPage=3;//блок расчета пангинации
    $from=($page*$notesOnPage)-3;
    $link=mysqli_connect($host,$user,$password,$db_name) or die(mysqli_error($link));
    $query = "SELECT * FROM miniproject WHERE id>0 ORDER BY id LIMIT $from,$notesOnPage  ";
    $result=mysqli_query($link,$query) or die(mysqli_error($link));
    for($data=[]; $row = mysqli_fetch_assoc($result);$data[]=$row);
    //панель с кнопками//

    echo"<div>
				<nav>
				  <ul class=\"pagination\">
					<li class=\"disabled\">
						<a href=\"?page=1\"  aria-label=\"Previous\">
							<span aria-hidden=\"true\">&laquo;</span>
						</a>
					</li>";
                    echo "<li ><a href=\"?page=1\">1</a></li>";
                    $k=ceil(($array_count[0])/$notesOnPage);
                    for($j=1;$j<=$k;$j++){
                        if($j>1){
					echo "<li><a href=\"?page=$j\">$j</a></li>";
					}}
					echo"<li>
						<a href=\"?page=$k\" aria-label=\"Next\">
							<span aria-hidden=\"true\">&raquo;</span>
						</a>
					</li>
				  </ul>
				</nav>
			</div>";//автоматическое создание списка страниц
    if (isset ($data[2])){//вывод данных из двумерного массива созданого пангинацией
        $text=$data[2]['recension'];
        echo "<div class=\"note\">
        <p>
            <span class=\"date\">".date('d.m.Y H:i:s',$data[2]['time'])."</span>
        <span class=\"name\">"."  ".$data[2]['name']."</span>
        </p>
        <p >
             $text
        </p>
    </div>";}
    if (isset ($data[1])){
        $text=$data[1]['recension'];
        echo "<div class=\"note\">
        <p>
            <span class=\"date\">".date('d.m.Y H:i:s',$data[1]['time'])."</span>
        <span class=\"name\">"."  ".$data[1]['name']."</span>
        </p>
        <p >
             $text
        </p>
    </div>";
    }
    if (isset ($data[0])){
        $text=$data[0]['recension'];
        echo "<div class=\"note\">
        <p>
            <span class=\"date\">".date('d.m.Y H:i:s',$data[0]['time'])."</span>
        <span class=\"name\">"."  ".$data[0]['name']."</span>
        </p>
        <p >
             $text
        </p>
    </div>";
    }
    ?>
    <?php if (isset($_POST['submission'])){//вывод сообщения о добавлении
        echo " <div class=\"info alert alert-info\">
        Your message saved success!!
    </div>";
    }
    ?>
    <div id="form">
        <form action="#form" method="POST"><!-- форма ввода HTML -->
            <p><input class="form-control" placeholder="Name" name="name"></p>
            <p><textarea class="form-control" placeholder="Your message" name="recension"></textarea></p>
            <p><input type="submit" class="btn btn-info btn-block" name="submission" value="Send"></p>
        </form>
    </div>
</div>
</body>
</html>
<?php
$double_check = "SELECT * FROM miniproject ORDER BY id DESC LIMIT 1 ";
$anti_double = mysqli_query($link, $double_check) or die(mysqli_error($link));
$checking_arr = mysqli_fetch_array($anti_double);
$recension_check=$checking_arr['recension'];
if (isset($_POST['submission'])&&($_POST['recension']!=$recension_check)) {
    $name = $_POST['name'];
    $recension = $_POST['recension'];
    $time = time();
    $query = "INSERT INTO miniproject SET name='$name', time='$time', recension='$recension'";
    mysqli_query($link, $query) or die(mysqli_error($link));
}
if (isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
?>
