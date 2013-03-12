<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>liangyou-download</title>
</head>

<body>
	<?php
		$types = array(
			'ba'=>'经动人心',//周  0
			'bc'=>'书香园地',//周  1-5
			'bf'=>'幸福满家园',
			'bv'=>'灵命日粮',
			'cc'=>'空中辅导',
			'ds'=>'晨曦讲座',
			'ee'=>'拥抱每一天',
			'gv'=>'生活无国界',
			'hg'=>'欢乐卡洽碰',
			'ws'=>'长夜的牵引',
			'se'=>'恋爱季节',
			'eg'=>'英语世界',
		);
		foreach($types as $key=>$value){
			?>
			<div class="d-list">
				<h3><?php echo $value;?></h3>
				<ul>
					<?php
							$mp3 = array('se');
							$media_type = 'wma';
							if(in_array($key, $mp3)) {
								$media_type = 'mp3';
							}
							$days = date( "t",mktime(0,0,0,date('m'),1,date('Y')));
							for	($i=1;$i<=$days;$i++){
								
								$day = str_pad($i, 2, "0", STR_PAD_LEFT);
								if(true||date('d')==$day){
									
									$str = date('y').date('m').$day.'.'.$media_type;
									if($key=='ba'&&date('w',mktime(0,0,0,date('m'),$i,date('Y')))!=0) continue;
									if($key=='bc'&&(date('w',mktime(0,0,0,date('m'),$day,date('Y')))==0||date('w',mktime(0,0,0,date('m'),$day,date('Y')))==6)) continue;
									echo "<li>http://liangyou.nissigz.com/media/$key/$key$str</li>";
									//echo "<li><a href='http://liangyou.nissigz.com/media/$key/$key$str'>".date('md')."</a></li>";
								}
							}		
					?>
				</ul>
			</div>
			
			<?php
		}
	?>	
</body>
</html>