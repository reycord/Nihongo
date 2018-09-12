<body>
<div class="container" on >
    <form action="" enctype="multipart/form-data" method="POST"> 
		<div class="col-sm-9 col-xs-9" style="float: left;">   
			<table  id="dataTable" class="display table table-bordered" cellspacing="0" >
				<thead class="titledt">
					<tr>
						<th style='width: 5%;text-align:center;vertical-align:middle' rowspan="2">ID</th>
						<th style='width: 18%;text-align:center;vertical-align:middle' rowspan="2">Tên</th>
						<th style='width: 6%;text-align:center;vertical-align:middle' rowspan="2">Level hiện tại</th>
						<th style='width: 6%;text-align:center;vertical-align:middle' rowspan="2">Level mục tiêu</th>
						<th style='width: 30%;text-align:center;vertical-align:middle' colspan="2">Hoàn thành</th>
						<th style='width: 5%;text-align:center;vertical-align:middle' rowspan="2">Tỷ lệ</th>
					</tr>
					<tr>
                        <th style='width: 15%;text-align:center;vertical-align:middle; border-top: 0px;'>Từ vựng</th>
                        <th style='width: 15%;text-align:center;vertical-align:middle; border-right: 1px solid #ddd; border-top: 0px;'>Ngữ pháp</th>
                    </tr>
				</thead>
				<tbody>
					<?php foreach ($data['data'] as $key => $row): ?>
					<tr>
						<td style=' text-align:center;vertical-align:middle'><?php echo $row['user_id'] ?></td>
						<td style=' text-align:center;vertical-align:middle; text-align: left;'><?php echo ucwords($row['name']) ?></td>
						<td style=' text-align:center;vertical-align:middle'>
						    <?php 
						      if($row['present_level'] != ""){
						          if((int)$row['certificate_flag'] == 0) {
                                    echo ucfirst($row['present_level'] . " (～)");
                                  } elseif((int)$row['certificate_flag'] == 1) {
                                        echo ucfirst($row['present_level']);
                                  }
                                } else {
                                    echo "-";
                                }
                            ?>
                        </td>
						<td style=' text-align:center;vertical-align:middle'>
						    <?php 
						      if($row['next_level'] != ""){
					              echo ucfirst($row['next_level']);
				              } else {
				                  echo "-";
				              }
						    ?>
					    </td>
						<td style=' text-align:center;vertical-align:middle'><?php echo $row['vocabulary'] . "/" . $row['totalVocabulary'] ?></td>
						<td style=' text-align:center;vertical-align:middle'><?php echo $row['grammar'] . "/" . $row['totalGrammar'] ?></td>
						<td style=' text-align:center;vertical-align:middle; text-align: right;'>
                            <?php 
                                if($row['totalVocabulary'] != 0 and $row['totalGrammar'] != 0){
                                    echo round((($row['vocabulary'] / $row['totalVocabulary']) + ($row['grammar'] / $row['totalGrammar'])) * 100 / 2, 1) . " %";
                                } elseif($row['totalVocabulary'] != 0 and $row['totalGrammar'] == 0){
                                    echo round(($row['vocabulary'] / $row['totalVocabulary']) * 100, 1) . " %";
                                } elseif($row['totalVocabulary'] == 0 and $row['totalGrammar'] != 0){
                                    echo round(($row['grammar'] / $row['totalGrammar']) * 100, 1) . " %";
                                } else {
                                    echo "0 %";
                                }
                            ?>
                        </td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3 col-xs-3" style="float: right;">
		    <div style="background:#E0F2F1; height: auto; width: 100%; line-height: 200%; border: 1px solid #ccc; font-size: 15px;" readonly="">
		        <p style="text-align: center; padding: 5px;">Thông tin kì thi<br>
		        Đến kỳ thi <span id="nextExam" style="color: blue; font-weight: bold;"></span> còn:<br>
		        <span id="countDownToNextExam" style="color: blue; font-weight: bold;"></span></p>
            </div>
	    </div>
	    
	    <div class="col-sm-3 col-xs-3" style="float: right; padding: 0px; margin-top: 20px;" id="chart_div"></div>
	</form>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            "scrollY":        "465px",
            "scrollCollapse": true,
            "paging":         false,
            "searching":    false,
            "bInfo":    false,
            "bSort":    false
        } );
    } );
    
    function nthWeekdayOfMonth(weekday, n, date) {
      var count = 0,
          idate = new Date(date.getFullYear(), date.getMonth(), 1);
      while (true) {
        if (idate.getDay() === weekday) {
          if (++count == n) {
            break;
          }
        }
        idate.setDate(idate.getDate() + 1);
      }
      return idate;
    }

    var today;
    var examDate;
    function parseDate() {
        today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var ddExam;
        var mmExam;
        
        if(mm <= 7){
            mmExam = '07';
            examDate = nthWeekdayOfMonth(0, 1, new Date(today.getFullYear(), mmExam - 1, '01'));
        } else {
            mmExam = '12';
            examDate = nthWeekdayOfMonth(0, 1, new Date(today.getFullYear(), mmExam - 1, '01'));
        }
        
        ddExam = examDate.getDate();
        ddExam = '0' + ddExam;
        
        if(dd < 10) {
            dd = '0' + dd;
        }
        if(mm < 10){
            mm = '0' + mm;
        }

        today = new Date(today.getFullYear(), mm - 1, dd);
        examDate = new Date(today.getFullYear(), mmExam - 1, ddExam);
    }
    
    function daydiff(first, second) {
        return Math.round((second-first)/(24*60*60*1000));
    }
    
    $(document).ready(function(event){
        parseDate();
        $('#nextExam').html((examDate.getMonth() + 1) + "/" + examDate.getFullYear());
        $('#countDownToNextExam').html(daydiff(today, examDate) + " ngày");
    });
    
    // add chart
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);
    
    function drawStacked() {
      var data = google.visualization.arrayToDataTable([
        ['Level', 'Đã có bằng', 'Tương đương', { role: 'annotation' } ],
        <?php foreach ($data['dataChart'] as $key => $row): ?>
            ['<?php echo $row['level'] ?>', <?php echo $row['cer'] ?>, <?php echo ($row['total'] - $row['cer']) ?>, ''],
       <?php endforeach ?>
      ]);

      var options = {
        height: 200,
        width: 300,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '50%' },
        isStacked: true,
        hAxis: {
          title: 'Tỷ lệ cấp độ tiếng Nhật',
          titleTextStyle: {
            bold: true,
            fontSize: 16,
            color: '#4d4d4d'
          }
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
      
      var x = document.getElementById("chart_div").firstChild.style.marginLeft  = "-15px";
    }
</script>

<?php //require_once __DIR__. "/../kpiresult/include.php" ?>