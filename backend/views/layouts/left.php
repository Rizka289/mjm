<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= "upload/".Yii::$app->user->identity->foto ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->nama?></p>
                <?php /* <a href="#"><i class="fa fa-circle text-success"></i> Online</a> */ ?>
            </div>
        </div>

        <?php 
		use backend\models\MenuNavigasi;
		use backend\models\MenuNavigasiRole;

			$hakakses = MenuNavigasiRole::find()->where(["in","id_system_role",Yii::$app->session->get('user_role_id')])->asArray()->all();

			$menu = MenuNavigasi::find()->where(["id_parent"=>0, "status"=>0])
			->andWhere(["in","id_menu",$hakakses])
			->orderBy("no_urut")->all();
			$strMenu = array();
			array_push($strMenu, array(
				'label' => 'MENU UTAMA',
				'options' => array('class' => 'header', 'style'=>'color: white'),
				 
			));
		
			foreach ($menu as $data)
			{
				$menu2 = MenuNavigasi::find()->where(["id_parent"=>$data->id_menu, "status"=>0])
				->andWhere(["in","id_menu",$hakakses])
				->orderBy("no_urut")->all();
				$url = "";
				if ($menu2)
				{
					//echo "1";
					$c = 0;
					$items = array();
					foreach ($menu2 as $data2)
					{				
						if (strpos($data2->url, "beecloud"))
						{
							$url = "https://app.beecloud.id/site/login";
						}
						else
						{
							$url = "index.php?r=".$data2->url;
						}
						array_push($items, array(
							'label' => $data2->nama_menu,
							'icon' => $data2->icon,
							'url' => $url,
							'options' => [
								'class' => $a = (Yii::$app->controller->id == $data2->url) ? 'active' : '',
							]
						));

						$b = ($a == 'active') ? 1 : 0;
						$c += $b;
					}
					
					
					array_push($strMenu, array(
						'label' => $data->nama_menu,
						'icon' => $data->icon,
						'url' => "index.php?r=".$data->url,
						'items'	=> $items,
						'options' => [
							'class' => ($c > 0) ? 'active' : '',
						]
					));
				}
				else
				{
					//echo "2";
					
					array_push($strMenu, array(
						'label' => $data->nama_menu,
						'icon' => $data->icon,
						'url' => "index.php?r=".$data->url,
						'label' => $data->nama_menu,
						'options' => [
							'class' => (Yii::$app->controller->id == $data->url) ? 'active' : '',
						]
					));
	
				}
			}

			//echo var_dump($strMenu);
		
			 
			echo dmstr\widgets\Menu::widget(
				[
					'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
					'items' => $strMenu
					
				]
			);
			
		
			?>

    </section>

</aside>
