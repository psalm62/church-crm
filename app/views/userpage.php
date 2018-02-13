<?php

/**
 * summary
 */
class UserPage extends View
{
	public function nav()
	{
		if($_SESSION)
		{
			echo '<nav>
				<ul>
					<li><a href="./quit" title="">Выход</a></li>
				</ul>
			</nav>';	
		}
	}
	public function all()
	{
		echo '<div style="margin:20px">';
			
		echo '<a class="btn btn-success" role="button" style="color:#fff">Приход</a><a class="btn btn-danger" role="button" style="color:#fff">Расход</a>';	

		echo "<table>
        	<thead>
        		<tr>
        			<th>Дата</th><th>Сумма</th><th>Статус</th>
        		</tr>
        	</thead>
        <tbody>";
		$all_summ=0;
		foreach ($this->data as $row) 
        {
        	foreach ($row as $key => $value) 
        	{
        		if($key=='id')
        		{
        			echo "<tr>";	
        			$date_paid = date('d-m-Y', strtotime($row['paidtime']));
        			echo "<td>".$date_paid."</td><td style='text-align:right'>".$row['sum']."</td>";
        			if(empty($row['hash']) && $_SESSION['id']==62)
        			{
        				echo "<td><a href='./delete/summ/".$row['id']."'>Удалить</a></td>";
        			}
        			elseif(empty($row['hash']) && $_SESSION['id']!=62)
        			{
        				echo "<td><a href='./ok/".$row['id']."'>Подписать</a></td>";
        			}
        			else
        			{
        				echo "<td style='color:green'>Подтверждено</td>";
        			}
        			echo "</tr>";
        		}
        	}
        	if(!empty($row['hash']))
        	{
        		$all_summ += $row['sum']; 	
        	}
        	
        }
        $all_summ = number_format($all_summ, 2, '.', '');
        echo "<tr><th style='text-align:right'>Итого:</th><th style='text-align:right'>{$all_summ}</th><td></td></tr>";
        echo "</tbody></table>";
        echo "<pre>";
        print_r($this->data);	
        echo "</pre>";
        echo '</div>';
	}
}