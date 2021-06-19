<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['todo']) || $_POST['todo'] == '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$todo = $_POST['todo'];
$deadline = $_POST['deadline'];


// ここからファイルアップロード&DB登録の処理を追加しよう！！！
