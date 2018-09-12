<script type="text/javascript">
	$(document).ready(function() {
  	$('.flashcard').on('click', function() {
    $('.flashcard').toggleClass('flipped');
  });
});
</script>
<body>
<div class="container">
<!-- <p>Lesson id= <?php //echo htmlspecialchars($_GET['Lesson_id']); ?> </p>
<p>Level= <?php //echo htmlspecialchars($_GET["Level"]); ?> </p> -->
<form method="post">
<div class="border" style="border: 1px solid #e4e4e4; padding:10px;">
<div>
<table style="width: 100%"> <?php $vocabulary=$data['vocabulary'];?>
	<tr>
		<td style="width:10%">LEVEL:<strong> <?php echo "N".$data['Levelhoc']?></strong></td>
		<td style="width:10%">Tên bài học:</td>
		<td style="width:20%;"><strong><?php echo $vocabulary['0']['lesson_title'];  ?></strong></td>
		<td style="width:4%"></td>
		<td style="width:20%; margin-left: 10px">Nội Dung: <strong><?php echo $_GET['type'] ?></strong></td>
		<td style="width:20%">Đã thuộc: <strong><?php foreach ($data['lesson'] as $key => $lesson) {
        if ($lesson['lesson_id'] == $data['lesson_id']) {
          echo ($lesson['vocabulary']."/".$lesson['totalVocabulary']);
         }
    }?></strong></td>
		<td style="width:16%"><button type="submit" class="btn btn-info" name="kiemtra" value="kiemtra">KIỂM TRA</button></td>
	</tr>
</table>
</div>
</div>

<div class="stage"><?php $i= $_SESSION['count']; ?>
  <div class="flashcard">
    <div class="front">
      <p style="margin-top: 25%"><?php if ($_GET['type'] =="Từ Vựng") {
       echo $vocabulary["$i"]['vocabulary_word']; 
      }
      else {
       echo $grammar["$i"]['grammar_structure'];
      }?></p>
    </div>
    <div class="back">
    <div style="height: 280px; overflow: scroll; vertical-align: middle; text-align: center; ">
      <p> <?php if ($_GET['type'] =="Từ Vựng") {
       echo $vocabulary["$i"]['vocabulary_word']; 
      }
      else {
       echo $grammar["$i"]['grammar_structure'];
      } ?></p> 
      <p> <?php if ($_GET['type'] =="Từ Vựng") {
       echo $vocabulary["$i"]['vocabulary_kanji']; 
      }
      else {
       echo $grammar["$i"]['grammar_mean'];
      } ?></p>
      <p> <?php if ($_GET['type'] =="Từ Vựng") {
       echo $vocabulary["$i"]['vocabulary_amhan']; 
      }
      else {
       echo $grammar["$i"]['grammar_use'];
      }?></p>
      <p> <?php if ($_GET['type'] =="Từ Vựng") {
       echo $vocabulary["$i"]['vocabulary_mean']; 
      }
      else {
       echo $grammar["$i"]['grammar_sample'];
      } ?></p>
      </div>
    </div>
  </div>  
</div> 
<div class="col-xs-12">
<div class="col-xs-offset-2">
<span><button type="submit" class="btn btn-info" name="prev" value="prev" style="text-align: center"><----</button></span>
<span style="margin-left: 100px"><button type="submit" class="btn btn-info" name="chuathuoc" value="chuathuoc" id="chuathuoc" style="width: 150px">CHƯA THUỘC</button></span>
<span style="margin-left: 10px"><button type="submit" class="btn btn-info" name="dathuoc" value="dathuoc" style="width:150px">ĐÃ THUỘC</button></span>
<span style="margin-left: 100px"><button type="submit" class="btn btn-info" name="next" value="next" style="text-align: center">---></button></span>
</div>

</div>
</form>
</div>
</body>