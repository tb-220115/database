<?php
// DB接続設定
//保存用
	$dsn = 'mysql:dbname=username;host=localhost';
	$user = 'username';
	$password = 'password';
	$pdo = new PDO($dsn, $user, $password,
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//4-2	
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);
//4-3
$sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";
//4-4
$sql = 'SHOW CREATE TABLE tbtest';
$result = $pdo -> query($sql);
foreach($result as $row){
    echo $row[1];
}
echo "<hr>";
//4-5
$sql = $pdo->prepare ("INSERT INTO tbtest (name,comment) VALUES(:name, :comment)");
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$name= 'o1';
$comment= 'おはよう';
$sql -> execute();
//4-6
//$sql = 'SELECT * FROM tbtest';
//$stmt = $pdo -> query($sql);
//$results = $stmt -> fetchAll();
//foreach($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    //echo $row['id'].',';
    //echo $row['name'].',';
    //echo $row['comment'].'<br>';
//echo "<hr>";
//}
//4-7  
//bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある。
//$id = 1; //変更する投稿番号
//$name = "おや１";
//$comment = "おっはよー"; //変更したい名前、変更したいコメントは自分で決めること
//$sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
//$stmt = $pdo->prepare($sql);
//$stmt->bindParam(':name', $name, PDO::PARAM_STR);
//$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
//$stmt->bindParam(':id', $id, PDO::PARAM_INT);
//$stmt->execute();
//4-6の実行
//$sql = 'SELECT * FROM tbtest';
//$stmt = $pdo -> query($sql);
//$results = $stmt -> fetchAll();
//foreach($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    //echo $row['id'].',';
    //echo $row['name'].',';
    //echo $row['comment'].'<br>';
//echo "<hr>";
//}
//4-8
$id=2;
$sql='delete from tbtest where id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
//続けて、4-6の SELECTで表示させる機能 も記述
$sql = 'SELECT * FROM tbtest';
$stmt = $pdo -> query($sql);
$results = $stmt -> fetchAll();
foreach($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].'<br>';
echo "<hr>";
}
?>