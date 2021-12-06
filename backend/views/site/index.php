<?php

/* @var $this yii\web\View */

if (Yii::$app->user->isGuest) { 
   header("Location: index.php");
   exit;
}
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Welcome, <?= Yii::$app->user->identity->nama?>!</h3>
        <p>Please select menu from navigation</p>
    </div>

</div>
