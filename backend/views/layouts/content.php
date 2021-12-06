<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use backend\models\Systemrole;
use backend\models\MenuNavigasi;
use backend\models\MenuNavigasiRole;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    //echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
	<?php
	$check = 0;
    
   /*
    $r = Yii::$app->request->get('r');
    $r = str_replace("%2F", "/", $r);
	
	
	
    if ($r == "") $r = "login";
    $menu = MenuNavigasi::find()->where(["url"=>$r])->one();

    if ($menu)
	{
   
    $menu_role = MenuNavigasiRole::find()
        ->select("id_system_role")
        ->where(["id_menu"=>$menu->id_menu])->asArray()->all();
        //echo var_dump(Yii::$app->session->get("user_role_id"));
        //echo "<br>";
        //echo var_dump($menu_role);

    
    $ada = 0;
    foreach (Yii::$app->session->get("user_role_id") as $data)
    {
        foreach ($menu_role as $data2)
        {
             
            if ($data == $data2['id_system_role'])
            {
                $ada = 1;
            }
        }
    }

	}
	else
	{
		$ada = 1;
	}
    

    if ($ada > 0 || $r == "login")
    {
    
		?>
        <?= "<br>".Alert::widget() ?>
        <?= $content ?>
		<?php
    }
    else
    {
        echo "<span class='alert alert-danger'>Anda tidak mempunyai akses ke halaman ini.</span>";
    }
	*/
	 
	
    
	?>
	<?= "<br>".Alert::widget() ?>
        <?= $content ?>
    </section>
</div>