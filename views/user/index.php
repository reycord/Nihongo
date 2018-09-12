<body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
    $("#sua").click(function(){
        $(".test").toggle();
        $(".info_level").toggle();
        if ($(this).val()=='Sửa') 
        {
        	$(this).val('Hủy');
        	$(this).attr('name','huy');
        }
        else
        {
        	$(this).val('Sửa');
        	$(".test").val("");
        	$(this).attr('name','sua');
        }
   
    });
     $('#dataTable').DataTable( {
	    "scrollY":        "500px",
	    "scrollCollapse": true,
	    "paging":         false,
	    "searching":    false,
	    "bInfo":    false,
	    "bSort":    false
	    
	} );
});
</script>

<style>
/*#huy{display:none;}*/
.test{display: none;}
</style>
<div class="container" on>
	<div class="border" style="border:1px solid #e4e4e4; padding:40px 35px; ">
		<div class="row">
			<div class="col-sm-4">
			<p style="height: 25px; line-height: 25px">ID: <strong><?php echo $data['user']->user_id; ?></strong></p><br>
			<p style="height: 25px; line-height: 25px">NAME: <strong><?php echo $data['user']->name; ?></strong></p>
			</div>
			<div class="col-sm-8">
			<div style="height: 25px;line-height: 25px">LEVEL HIỆN TẠI: <select style="margin-left: 9px" id="present_level" name="present_level" class="test" form="formUpdate">
	<?php foreach ($data['listLevel'] as $key => $row): ?>
        <option value="<?php echo $row['certificate_id'] ?>"
                <?php if($data['user']->present_level == $row['certificate_id']){echo("selected");}?> >
                <?php echo $row['certificate_title']?>
        </option>
    <?php endforeach ?>                            
    </select><span style="margin-left: 9px" class="info_level"><strong>
				<?php if ($data['user']->present_level==null) {echo "Chưa có!";}
					else echo ("N".$data['user']->present_level); ?></strong> </span></div> <br>
			<div style="height: 25px; line-height: 25px">LEVEL MỤC TIÊU: <select id="next_level" name="next_level" class="test" form="formUpdate" >
	<?php foreach ($data['listLevel'] as $key => $row): ?>
        <option value="<?php echo $row['certificate_id'] ?>"
                <?php if($data['user']->next_level == $row['certificate_id']){echo("selected");}?> >
                <?php echo $row['certificate_title']?>
        </option>
    <?php endforeach ?>                            
    </select><span class="info_level"><strong><?php echo ("N".$data['user']->next_level); ?></strong></span></div>
			</div>
		</div>

		<div class="col-sm-offset-7">

		<table>
		<tr>
		<td><input type="submit" name="sua"  value="Sửa" id="sua" class="btn btn-info"/></td>
		<td width="10px"></td>
		<td>
			<button type="submit" name="luu" class="btn btn-info" value="luu" id="luu" form="formUpdate">Lưu</button>
		</td>
		</tr>
		</table>
		</div>
	</div> <!-- end border -->
	
	<form action="" enctype="multipart/form-data" method="POST"  style="margin-top: 10px" id="formUpdate"> 
	<div style="margin-top:10px">
 	<p>LEVEL HỌC: 
	<select name="LessonLevel" id="LessonLevel" onchange="this.form.submit();">
	<?php $tam =1; foreach ($data['listLevel'] as $key => $row): ?>
	  <option value="<?php echo $row['certificate_id'] ?>" <?php if ($row['certificate_id']==$data['Levelhoc']){echo "selected";}?>>
	  		<?php echo $row['certificate_title'] ?>  	
	  </option>
	<?php endforeach ?> 
	</select> 
	</p>
	</div>
		<div class="border">
			<table  id="dataTable" class="display table table-bordered" cellspacing="0" >
				<thead class="titledt">
					<tr>
						<th style='width: 28%;text-align:center;vertical-align:middle' rowspan="2">TÊN BÀI HỌC</th>
						<th style='width: 10%;text-align:center;vertical-align:middle' rowspan="2">NỘI DUNG</th>
						<th style='width: 12%;text-align:center;vertical-align:middle' rowspan="2">ĐÃ THUỘC</th>
						<th style='width: 10%;text-align:center;vertical-align:middle' rowspan="2">TỈ LỆ</th>
						<th style='width: 20%;text-align:center;vertical-align:middle' rowspan="2">KẾT QUẢ KIỂM TRA</th>
						<th style='width: 20%;text-align:center;vertical-align:middle' colspan="2">CHỨC NĂNG</th>
						
						
			
					</tr>
					<tr>
					        <th style="display:none"></th>
					        <th style="display:none"></th>
					</tr>
				</thead>
				<tbody> <?php $type_content = $data['type_content'] ?>
					<?php foreach ($data['lesson'] as $key => $value): ?>
					 
					 <tr>
					 	<td style='text-align:left;vertical-align:middle' rowspan="2"><?php echo $value['lesson_title'] ?></td>
					 	<!--End cell bài học -->
						
					 	<td style='text-align:center;vertical-align:middle'><?php echo $type_content['0']['type_content'] ?></td>
					 	<td style='text-align:center;vertical-align:middle'><?php echo ($value['vocabulary']."/".$value['totalVocabulary']) ?></td>
					 	<td style='text-align:right;vertical-align:middle'><?php echo(round(($value['vocabulary']/$value['totalVocabulary'])*'100',1)."%") ?></td>
					 	<td style='text-align:center;vertical-align:middle'>ket qua </td>
					 	<td style='text-align:center;vertical-align:middle'><button type="submit" name="hoctuvung"  value="<?php echo($value['lesson_id'])?>" id="hoc" class="btn btn-info">HỌC</button></td>
					 	<td style='text-align:center;vertical-align:middle'><button type="submit" name="kiemtra"  value="<?php echo($value['lesson_id'])?>" id="kiemtra" class="btn btn-info">KIỂM TRA</button></td>
					 </tr>
					 <tr>
					 	<td style='text-align:center;vertical-align:middle; display: none'></td>
					 	<td style='text-align:center;vertical-align:middle'><?php echo $type_content['1']['type_content'] ?></td>
					 	<td style='text-align:center;vertical-align:middle'><?php echo ($value['grammar']."/".$value['totalGrammar']) ?></td>
					 	<td style='text-align:right;vertical-align:middle'><?php echo(round(($value['grammar']/$value['totalGrammar'])*'100',1)."%") ?></td>
					 	<td style='text-align:center;vertical-align:middle'>ket qua </td>
					 	<td style='text-align:center;vertical-align:middle'><button type="submit" name="hocnguphap"  value="<?php echo($value['lesson_id'])?>" id="hoc" class="btn btn-info">HỌC</button></td>
					 	<td style='text-align:center;vertical-align:middle'><button type="submit" name="kiemtra"  value="<?php echo($value['lesson_id'])?>" id="kiemtra" class="btn btn-info">KIỂM TRA</button></td>
					 </tr>

					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</form>

	</div> <!-- end container -->
</body>


